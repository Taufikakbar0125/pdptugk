<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KomitmenMahasiswa;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KomitmenMahasiswaAdminController extends Controller
{
    /**
     * Daftar semua pengajuan komitmen mahasiswa.
     */
    public function index(Request $request)
    {
        $query = KomitmenMahasiswa::latest();

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

        return view('admin.komitmen-mahasiswa.index', compact('items'));
    }

    /**
     * Detail pengajuan komitmen mahasiswa.
     */
    public function show(string $id)
    {
        $item = KomitmenMahasiswa::findOrFail($id);

        $driveService = app(GoogleDriveService::class);
        $gdriveConnected = $driveService->isAuthorized();

        return view('admin.komitmen-mahasiswa.show', compact('item', 'gdriveConnected'));
    }

    /**
     * Update status pengajuan komitmen.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status'        => 'required|in:menunggu,diproses,selesai',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $item = KomitmenMahasiswa::findOrFail($id);
        $item->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.komitmen-mahasiswa.index')
            ->with('success', 'Status pengajuan komitmen berhasil diperbarui.');
    }

    /**
     * Push berkas ke Google Drive (folder khusus komitmen).
     */
    public function pushToGDrive(string $id, GoogleDriveService $driveService)
    {
        $item = KomitmenMahasiswa::findOrFail($id);

        // Validasi: hanya bisa push jika status selesai dan belum pernah dipush
        if ($item->status !== 'selesai') {
            return back()->with('error', 'Hanya pengajuan dengan status "Selesai" yang dapat di-push ke Google Drive.');
        }

        if ($item->gdrive_pushed_at) {
            return back()->with('error', 'Berkas pengajuan ini sudah pernah di-push ke Google Drive.');
        }

        if (!$driveService->isAuthorized()) {
            return back()->with('error', 'Google Drive belum terhubung. Silakan authorize terlebih dahulu di Dashboard Admin.');
        }

        if (!$item->file_path || !Storage::disk('public')->exists($item->file_path)) {
            return back()->with('error', 'File berkas tidak ditemukan di server.');
        }

        try {
            // Buat subfolder di Google Drive (folder komitmen)
            $folderName = "[{$item->nim}] {$item->nama} - {$item->tindak_lanjut} ({$item->created_at->format('d-m-Y')})";
            $komitmenFolderId = config('google.komitmen_folder_id');

            $folder = $driveService->createSubfolder($folderName, $komitmenFolderId);

            // Upload file ke subfolder
            $localPath = Storage::disk('public')->path($item->file_path);
            $fileName = "Berkas Komitmen - {$item->nama} ({$item->nim})." . pathinfo($item->file_path, PATHINFO_EXTENSION);

            $uploadResult = $driveService->uploadFile($localPath, $fileName, $folder['id']);

            // Hapus file lokal
            Storage::disk('public')->delete($item->file_path);

            // Update record
            $item->update([
                'gdrive_file_url'   => $uploadResult['url'],
                'gdrive_folder_url' => $folder['url'],
                'gdrive_pushed_at'  => now(),
            ]);

            return back()->with('success', '✅ Berkas berhasil di-push ke Google Drive dan file lokal telah dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal push ke Google Drive: ' . $e->getMessage());
        }
    }
}
