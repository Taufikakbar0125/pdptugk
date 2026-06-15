@extends('admin.layouts.app')

@section('title', 'Edit Buku Informasi Akademik')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Buku Informasi Akademik</h1>
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

        <form action="{{ route('admin.buku-akademik.update', $buku_akademik->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Judul Buku</label>
                <input type="text" name="judul" value="{{ old('judul', $buku_akademik->judul) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Semester</label>
                    <select name="semester" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                        <option value="Gasal" {{ old('semester', $buku_akademik->semester) == 'Gasal' ? 'selected' : '' }}>Gasal</option>
                        <option value="Genap" {{ old('semester', $buku_akademik->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tahun Akademik</label>
                    <input type="text" name="tahun_akademik" value="{{ old('tahun_akademik', $buku_akademik->tahun_akademik) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tahun Masuk (Start Year)</label>
                <input type="number" name="start_year" value="{{ old('start_year', $buku_akademik->start_year) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Upload File Dokumen Baru (PDF, Maks 10MB)</label>
                @if($buku_akademik->file_path)
                    <div style="margin-bottom: 8px; font-size: 0.875rem; color: #475569;">
                        File saat ini: <a href="{{ asset('storage/' . $buku_akademik->file_path) }}" target="_blank" style="color: #2563eb;">Lihat File ({{ $buku_akademik->file_size }})</a>
                    </div>
                @endif
                <input type="file" name="file_dokumen" accept="application/pdf" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc;">
                <span style="font-size: 0.75rem; color: #64748b; margin-top: 4px; display: block;">Biarkan kosong jika tidak ingin mengubah file dokumen.</span>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Simpan Perubahan</button>
                <a href="{{ route('admin.buku-akademik.index') }}" style="padding: 10px 20px; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569; text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
