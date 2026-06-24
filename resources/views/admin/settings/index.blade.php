@extends('admin.layouts.app')

@section('title', 'Pengaturan Web')

@section('content')
<style>
    .settings-container {
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }
    .settings-header {
        margin-bottom: 28px;
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        padding-bottom: 16px;
    }
    .settings-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }
    .settings-desc {
        font-size: 0.9rem;
        color: #64748b;
    }
    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .preview-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 180px;
        margin-bottom: 16px;
    }
    .preview-box img {
        max-height: 100px;
        max-width: 100%;
        object-fit: contain;
    }
    .file-input-wrapper {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px;
        background: #fff;
    }
    .file-input {
        width: 100%;
        font-size: 0.85rem;
        color: #64748b;
    }
    .file-input::file-selector-button {
        background: #eff6ff;
        color: #3b82f6;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 12px;
        transition: background 0.2s;
    }
    .file-input::file-selector-button:hover {
        background: #dbeafe;
    }
    .info-box {
        background: rgba(241, 245, 249, 0.5);
        border: 1px solid #e2e8f0;
        padding: 20px;
        border-radius: 12px;
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.6;
        margin-top: 32px;
    }
    .info-box strong {
        color: #0f172a;
    }
    .btn-save {
        background: #2563eb;
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }
    .btn-save:hover {
        background: #1d4ed8;
    }
    .settings-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
    }
    @media (max-width: 768px) {
        .settings-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="settings-container">
    <div class="settings-header">
        <h1 class="settings-title">Pengaturan Web</h1>
        <p class="settings-desc">Kelola konfigurasi dan logo situs secara terpusat.</p>
    </div>

    @if(session('success'))
    <div class="alert-success">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="settings-grid">
            <!-- Left Column: Logo -->
            <div>
                <div class="form-group">
                    <label class="form-label">Pratinjau Logo Saat Ini</label>
                    <div class="preview-box">
                        <img src="{{ $global_site_logo }}" alt="Logo Saat Ini">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Unggah Logo Baru</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="site_logo" accept="image/png, image/jpeg, image/svg+xml" class="file-input">
                    </div>
                    <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 8px;">Format yang didukung: PNG, JPG, SVG. Maks 2MB.</p>
                    @error('site_logo')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column: Info -->
            <div>
                <div class="info-box">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; color: #0f172a;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <strong>Informasi</strong>
                    </div>
                    <p>
                        Logo yang Anda unggah di sini akan otomatis memperbarui tampilan di seluruh sistem, termasuk halaman <strong>Depan (Portal)</strong>, <strong>Login Admin</strong>, dan <strong>SSO Mahasiswa</strong>. 
                        <br><br>
                        Sangat disarankan menggunakan logo dengan latar belakang transparan (berformat <strong>PNG</strong> atau <strong>SVG</strong>) agar dapat menyatu dengan baik pada berbagai warna latar belakang.
                    </p>
                </div>
            </div>
        </div>

        <div style="margin-top: 32px; border-top: 1px solid rgba(226, 232, 240, 0.6); padding-top: 24px; text-align: right;">
            <button type="submit" class="btn-save">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
