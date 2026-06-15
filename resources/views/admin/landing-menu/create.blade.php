@extends('admin.layouts.app')

@section('title', 'Tambah Landing Portal')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Landing Portal (Globe)</h1>
</div>

<div class="admin-card">
    <div class="card-body">
        <form action="{{ route('admin.landing-menu.store') }}" method="POST">
            @csrf
            <div class="form-group" style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Nama Menu</label>
                <input type="text" name="name" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>
            <div class="form-group" style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Deskripsi Singkat</label>
                <textarea name="desc" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" rows="3"></textarea>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Ikon (Emoji)</label>
                    <input type="text" name="icon" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Urutan Tampil</label>
                    <input type="number" name="order_num" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" value="1" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">URL Tujuan</label>
                <input type="text" name="url" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" placeholder="/pdpt/home atau https://...">
            </div>
            <div class="form-group" style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 0.875rem;">Tema Warna Planet</label>
                <select name="theme" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
                    <option value="blue">Blue (Biru PDPT)</option>
                    <option value="green">Green (Hijau Konversi)</option>
                    <option value="brown">Brown (Coklat Validasi)</option>
                    <option value="purple">Purple (Ungu Akreditasi Nas)</option>
                    <option value="cyan">Cyan (Cyan Akreditasi Int)</option>
                    <option value="red">Red (Merah)</option>
                    <option value="gold">Gold (Emas)</option>
                </select>
            </div>
            
            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn" style="width: auto; padding: 10px 24px;">Simpan</button>
                <a href="{{ route('admin.landing-menu.index') }}" class="btn btn-danger" style="width: auto; padding: 10px 24px; background: #ef4444;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
