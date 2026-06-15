@extends('admin.layouts.app')

@section('title', 'Edit Landing Portal')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Landing Portal (Globe)</h1>
</div>

<div class="admin-card">
    <div class="card-body">
        <form action="{{ route('admin.landing-menu.update', $landingMenu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group" style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Nama Menu</label>
                <input type="text" name="name" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" value="{{ $landingMenu->name }}" required>
            </div>
            <div class="form-group" style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Deskripsi Singkat</label>
                <textarea name="desc" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" rows="3">{{ $landingMenu->desc }}</textarea>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Ikon (Emoji)</label>
                    <input type="text" name="icon" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" value="{{ $landingMenu->icon }}">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Urutan Tampil</label>
                    <input type="number" name="order_num" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" value="{{ $landingMenu->order_num }}" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">URL Tujuan</label>
                <input type="text" name="url" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" value="{{ $landingMenu->url }}">
            </div>
            <div class="form-group" style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Tema Warna Planet</label>
                <select name="theme" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
                    <option value="blue" {{ $landingMenu->theme == 'blue' ? 'selected' : '' }}>Blue (Biru PDPT)</option>
                    <option value="green" {{ $landingMenu->theme == 'green' ? 'selected' : '' }}>Green (Hijau Konversi)</option>
                    <option value="brown" {{ $landingMenu->theme == 'brown' ? 'selected' : '' }}>Brown (Coklat Validasi)</option>
                    <option value="purple" {{ $landingMenu->theme == 'purple' ? 'selected' : '' }}>Purple (Ungu Akreditasi Nas)</option>
                    <option value="cyan" {{ $landingMenu->theme == 'cyan' ? 'selected' : '' }}>Cyan (Cyan Akreditasi Int)</option>
                    <option value="red" {{ $landingMenu->theme == 'red' ? 'selected' : '' }}>Red (Merah)</option>
                    <option value="gold" {{ $landingMenu->theme == 'gold' ? 'selected' : '' }}>Gold (Emas)</option>
                </select>
            </div>
            
            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn" style="width: auto; padding: 10px 24px;">Simpan Perubahan</button>
                <a href="{{ route('admin.landing-menu.index') }}" class="btn btn-danger" style="width: auto; padding: 10px 24px; background: #ef4444;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
