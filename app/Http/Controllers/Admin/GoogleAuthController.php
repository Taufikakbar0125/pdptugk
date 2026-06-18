<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    /**
     * Redirect ke halaman consent Google OAuth.
     */
    public function redirect(GoogleDriveService $driveService)
    {
        return redirect()->away($driveService->getAuthUrl());
    }

    /**
     * Handle callback dari Google OAuth, simpan token.
     */
    public function callback(Request $request, GoogleDriveService $driveService)
    {
        if ($request->has('error')) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Gagal authorize Google Drive: ' . $request->error);
        }

        try {
            $driveService->handleCallback($request->code);
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Gagal authorize Google Drive: ' . $e->getMessage());
        }

        return redirect()->route('admin.dashboard')
            ->with('success', '✅ Google Drive berhasil terhubung! Anda sekarang dapat menggunakan fitur Push ke GDrive.');
    }

    /**
     * Putuskan koneksi Google Drive (hapus token).
     */
    public function disconnect(GoogleDriveService $driveService)
    {
        $driveService->revokeToken();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Koneksi Google Drive berhasil diputus.');
    }

    /**
     * Cek status koneksi Google Drive (JSON endpoint).
     */
    public function status(GoogleDriveService $driveService)
    {
        return response()->json([
            'connected' => $driveService->isAuthorized(),
        ]);
    }
}
