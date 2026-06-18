@extends('admin.layouts.app')

@section('title', 'Tambah Slide')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Slide Baru</h1>
</div>

<div class="admin-card">
    <div class="card-body">
        <form action="{{ route('admin.hero-slide.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-weight: 600; font-size: 0.875rem; color: #334155; display: block; margin-bottom: 6px;">
                    Gambar Slide <span style="color: #ef4444;">*</span>
                </label>
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp" required
                       style="width: 100%; padding: 10px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.875rem;"
                       onchange="previewImage(this)">
                <div id="imagePreview" style="margin-top: 12px; display: none;">
                    <img id="previewImg" src="" alt="Preview" style="max-width: 400px; max-height: 220px; border-radius: 12px; border: 1px solid #e2e8f0; object-fit: cover;">
                </div>
                <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 6px;">Format: JPG, PNG, WebP. Maks: 5MB. Rekomendasi: 1200×600px</p>
                @error('image')
                    <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-weight: 600; font-size: 0.875rem; color: #334155; display: block; margin-bottom: 6px;">Judul (opsional)</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Wisuda Periode 2025"
                       style="width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.875rem; outline: none;">
                @error('title')
                    <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label style="font-weight: 600; font-size: 0.875rem; color: #334155; display: block; margin-bottom: 6px;">
                        Urutan <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="number" name="order_num" value="{{ old('order_num', 0) }}" min="0"
                           style="width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.875rem; outline: none;">
                    @error('order_num')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="display: flex; align-items: center; padding-top: 26px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 0.875rem; font-weight: 500; color: #334155;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" checked
                               style="width: 18px; height: 18px; cursor: pointer;">
                        Aktif (tampilkan di homepage)
                    </label>
                </div>
            </div>

            <div style="display: flex; gap: 12px; padding-top: 12px;">
                <button type="submit" class="btn" style="width: auto; padding: 10px 24px;">Simpan</button>
                <a href="{{ route('admin.hero-slide.index') }}" style="padding: 10px 24px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.875rem; color: #64748b; text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
