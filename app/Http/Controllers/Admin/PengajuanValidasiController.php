<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanValidasi;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengajuanValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PengajuanValidasi::with('jenisMasalah')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(15)->withQueryString();

        return view('admin.pengajuan-validasi.index', compact('items'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = PengajuanValidasi::with(['user', 'jenisMasalah', 'pengajuanDokumens'])->findOrFail($id);

        // Cek apakah Google Drive sudah terkoneksi
        $driveService = app(GoogleDriveService::class);
        $gdriveConnected = $driveService->isAuthorized();

        return view('admin.pengajuan-validasi.show', compact('item', 'gdriveConnected'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:data di terima,data di tinjau,data dikembalikan untuk diperbarui,data di proses,pengajuan selesai',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $item = PengajuanValidasi::findOrFail($id);
        $item->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.pengajuan-validasi.index')->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    /**
     * Push semua berkas pendukung ke Google Drive, lalu hapus file lokal.
     */
    public function pushToGDrive(string $id, GoogleDriveService $driveService)
    {
        $item = PengajuanValidasi::with(['jenisMasalah', 'pengajuanDokumens'])->findOrFail($id);

        // Validasi: hanya bisa push jika status selesai dan belum pernah dipush
        if ($item->status !== 'pengajuan selesai') {
            return back()->with('error', 'Hanya pengajuan dengan status "Pengajuan Selesai" yang dapat di-push ke Google Drive.');
        }

        if ($item->gdrive_pushed_at) {
            return back()->with('error', 'Berkas pengajuan ini sudah pernah di-push ke Google Drive.');
        }

        // Cek apakah sudah authorize
        if (!$driveService->isAuthorized()) {
            return back()->with('error', 'Google Drive belum terhubung. Silakan authorize terlebih dahulu di menu Admin.');
        }

        // Cek apakah ada berkas untuk di-push
        if ($item->pengajuanDokumens->isEmpty()) {
            return back()->with('error', 'Tidak ada berkas pendukung yang dapat di-push.');
        }

        try {
            // 1. Buat subfolder di Google Drive
            $kategori = $item->jenisMasalah->nama_masalah ?? 'Umum';
            $folderName = "[{$item->nim}] {$item->nama} - {$kategori} ({$item->created_at->format('d-m-Y')})";

            $folder = $driveService->createSubfolder($folderName);

            // 2. Upload semua berkas ke subfolder
            foreach ($item->pengajuanDokumens as $doc) {
                $localPath = Storage::disk('public')->path($doc->file_path);

                if (!file_exists($localPath)) {
                    continue; // Skip jika file sudah tidak ada
                }

                $fileName = $doc->nama_dokumen . ' - ' . basename($doc->file_path);
                $uploadResult = $driveService->uploadFile($localPath, $fileName, $folder['id']);

                // Simpan URL GDrive ke record dokumen
                $doc->update([
                    'gdrive_file_url' => $uploadResult['url'],
                ]);

                // Hapus file lokal
                Storage::disk('public')->delete($doc->file_path);
            }

            // 3. Update record pengajuan
            $item->update([
                'gdrive_folder_url' => $folder['url'],
                'gdrive_pushed_at'  => now(),
            ]);

            return back()->with('success', '✅ Semua berkas berhasil di-push ke Google Drive dan file lokal telah dihapus untuk menghemat storage server.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal push ke Google Drive: ' . $e->getMessage());
        }
    }
}
