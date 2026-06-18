<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Facades\Storage;

class GoogleDriveService
{
    protected Client $client;
    protected ?Drive $driveService = null;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(config('google.client_id'));
        $this->client->setClientSecret(config('google.client_secret'));
        $this->client->setRedirectUri(config('google.redirect_uri'));
        $this->client->addScope(Drive::DRIVE_FILE);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
    }

    /**
     * Mendapatkan URL untuk authorization Google OAuth.
     */
    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    /**
     * Menukar authorization code dari Google callback menjadi token,
     * lalu simpan refresh token ke file JSON.
     */
    public function handleCallback(string $code): void
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);

        if (isset($token['error'])) {
            throw new \Exception('Google OAuth Error: ' . ($token['error_description'] ?? $token['error']));
        }

        // Simpan token lengkap (termasuk refresh_token)
        file_put_contents(config('google.token_path'), json_encode($token));
    }

    /**
     * Cek apakah token sudah tersimpan (sudah pernah authorize).
     */
    public function isAuthorized(): bool
    {
        return file_exists(config('google.token_path'));
    }

    /**
     * Inisialisasi Drive Service dengan token yang tersimpan.
     */
    protected function initDriveService(): Drive
    {
        if ($this->driveService) {
            return $this->driveService;
        }

        $tokenPath = config('google.token_path');

        if (!file_exists($tokenPath)) {
            throw new \Exception('Google Drive belum di-authorize. Silakan authorize terlebih dahulu di menu Admin.');
        }

        $token = json_decode(file_get_contents($tokenPath), true);
        $this->client->setAccessToken($token);

        // Jika token expired, refresh otomatis
        if ($this->client->isAccessTokenExpired()) {
            $refreshToken = $this->client->getRefreshToken();

            if (!$refreshToken) {
                // Hapus token lama yang sudah tidak valid
                @unlink($tokenPath);
                throw new \Exception('Refresh token tidak ditemukan. Silakan authorize ulang Google Drive di menu Admin.');
            }

            $newToken = $this->client->fetchAccessTokenWithRefreshToken($refreshToken);

            if (isset($newToken['error'])) {
                @unlink($tokenPath);
                throw new \Exception('Gagal me-refresh token Google: ' . ($newToken['error_description'] ?? $newToken['error']));
            }

            // Simpan token baru (pastikan refresh_token tetap ada)
            if (!isset($newToken['refresh_token'])) {
                $newToken['refresh_token'] = $refreshToken;
            }
            file_put_contents($tokenPath, json_encode($newToken));
        }

        $this->driveService = new Drive($this->client);
        return $this->driveService;
    }

    /**
     * Membuat subfolder di Google Drive.
     *
     * @return array ['id' => string, 'url' => string]
     */
    public function createSubfolder(string $folderName, ?string $parentFolderId = null): array
    {
        $service = $this->initDriveService();
        $parentId = $parentFolderId ?? config('google.folder_id');

        $folderMetadata = new DriveFile([
            'name'     => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents'  => [$parentId],
        ]);

        $folder = $service->files->create($folderMetadata, [
            'fields' => 'id, webViewLink',
        ]);

        return [
            'id'  => $folder->getId(),
            'url' => $folder->getWebViewLink(),
        ];
    }

    /**
     * Upload file ke Google Drive.
     *
     * @return array ['id' => string, 'url' => string]
     */
    public function uploadFile(string $localFilePath, string $fileName, string $parentFolderId): array
    {
        $service = $this->initDriveService();

        if (!file_exists($localFilePath)) {
            throw new \Exception("File tidak ditemukan: {$localFilePath}");
        }

        $fileMetadata = new DriveFile([
            'name'    => $fileName,
            'parents' => [$parentFolderId],
        ]);

        $content = file_get_contents($localFilePath);
        $mimeType = mime_content_type($localFilePath) ?: 'application/octet-stream';

        $file = $service->files->create($fileMetadata, [
            'data'       => $content,
            'mimeType'   => $mimeType,
            'uploadType' => 'multipart',
            'fields'     => 'id, webViewLink',
        ]);

        return [
            'id'  => $file->getId(),
            'url' => $file->getWebViewLink(),
        ];
    }

    /**
     * Hapus token yang tersimpan (logout Google Drive).
     */
    public function revokeToken(): void
    {
        $tokenPath = config('google.token_path');

        if (file_exists($tokenPath)) {
            $token = json_decode(file_get_contents($tokenPath), true);
            try {
                $this->client->setAccessToken($token);
                $this->client->revokeToken();
            } catch (\Exception $e) {
                // Tetap hapus file meskipun revoke gagal
            }
            @unlink($tokenPath);
        }
    }
}
