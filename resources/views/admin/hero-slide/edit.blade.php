@extends('admin.layouts.app')

@section('title', 'Edit Slide')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Slide</h1>
</div>

<div class="admin-card">
    <div class="card-body">
        <form action="{{ route('admin.hero-slide.update', $heroSlide->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-weight: 600; font-size: 0.875rem; color: #334155; display: block; margin-bottom: 6px;">Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $heroSlide->image_path) }}" alt="{{ $heroSlide->title }}"
                     style="max-width: 400px; max-height: 220px; border-radius: 12px; border: 1px solid #e2e8f0; object-fit: cover; display: block; margin-bottom: 12px;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-weight: 600; font-size: 0.875rem; color: #334155; display: block; margin-bottom: 6px;">Ganti Gambar (opsional)</label>
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                       style="width: 100%; padding: 10px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.875rem;"
                       onchange="previewImage(this)">
                <div id="imagePreview" style="margin-top: 12px; display: none;">
                    <img id="previewImg" src="" alt="Preview baru" style="max-width: 400px; max-height: 220px; border-radius: 12px; border: 1px solid #e2e8f0; object-fit: cover;">
                </div>
                <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 6px;">Kosongkan jika tidak ingin mengganti. Format: JPG, PNG, WebP. Maks: 5MB</p>
                @error('image')
                    <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-weight: 600; font-size: 0.875rem; color: #334155; display: block; margin-bottom: 6px;">Judul (opsional)</label>
                <input type="text" name="title" value="{{ old('title', $heroSlide->title) }}" placeholder="Contoh: Wisuda Periode 2025"
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
                    <input type="number" name="order_num" value="{{ old('order_num', $heroSlide->order_num) }}" min="0"
                           style="width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.875rem; outline: none;">
                    @error('order_num')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="display: flex; align-items: center; padding-top: 26px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 0.875rem; font-weight: 500; color: #334155;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ $heroSlide->is_active ? 'checked' : '' }}
                               style="width: 18px; height: 18px; cursor: pointer;">
                        Aktif (tampilkan di homepage)
                    </label>
                </div>
            </div>

            <div style="display: flex; gap: 12px; padding-top: 12px;">
                <button type="submit" class="btn" style="width: auto; padding: 10px 24px;">Simpan Perubahan</button>
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
