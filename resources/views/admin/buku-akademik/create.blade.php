@extends('admin.layouts.app')

@section('title', 'Tambah Buku Informasi Akademik')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Buku Informasi Akademik</h1>
</div>

<div class="admin-card" style="max-width: 600px;">
    <div class="card-body">
        @if($errors->any())
            <div style="padding: 12px; background: #fef2f2; color: #991b1b; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.buku-akademik.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Judul Buku</label>
                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Informasi Akademik Gasal 2024-2025" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Semester</label>
                    <select name="semester" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                        <option value="">Pilih Semester</option>
                        <option value="Gasal" {{ old('semester') == 'Gasal' ? 'selected' : '' }}>Gasal</option>
                        <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tahun Akademik</label>
                    <input type="text" name="tahun_akademik" value="{{ old('tahun_akademik') }}" placeholder="Contoh: 2024-2025" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tahun Masuk (Start Year) - Untuk Urutan</label>
                <input type="number" name="start_year" value="{{ old('start_year', date('Y')) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Upload File Dokumen (PDF, Maks 10MB)</label>
                <input type="file" name="file_dokumen" accept="application/pdf" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc;">
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Simpan Data</button>
                <a href="{{ route('admin.buku-akademik.index') }}" style="padding: 10px 20px; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569; text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
