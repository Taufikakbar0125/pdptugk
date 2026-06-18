<?php

return [
    'client_id'     => env('GOOGLE_DRIVE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
    'folder_id'     => env('GOOGLE_DRIVE_FOLDER_ID'),
    'redirect_uri'  => env('APP_URL', 'http://localhost:8000') . '/admin/google/callback',
    'token_path'    => storage_path('app/google-drive-token.json'),
];
