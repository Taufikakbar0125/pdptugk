@extends('admin.layouts.app')

@section('title', 'Tambah Akreditasi Institusi')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Akreditasi Institusi</h1>
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

        <form action="{{ route('admin.akreditasi-institusi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Peringkat Akreditasi</label>
                <select name="peringkat" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                    <option value="">Pilih Peringkat</option>
                    <option value="Unggul" {{ old('peringkat') == 'Unggul' ? 'selected' : '' }}>Unggul</option>
                    <option value="Baik Sekali" {{ old('peringkat') == 'Baik Sekali' ? 'selected' : '' }}>Baik Sekali</option>
                    <option value="Baik" {{ old('peringkat') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="A" {{ old('peringkat') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('peringkat') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('peringkat') == 'C' ? 'selected' : '' }}>C</option>
                </select>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Nomor SK</label>
                <input type="text" name="no_sk" value="{{ old('no_sk') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tahun SK</label>
                <input type="number" name="tahun_sk" value="{{ old('tahun_sk') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tanggal Kadaluarsa</label>
                <input type="date" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Status</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Kadaluarsa" {{ old('status') == 'Kadaluarsa' ? 'selected' : '' }}>Kadaluarsa</option>
                </select>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">File Sertifikat (PDF)</label>
                <input type="file" name="file_pdf" accept=".pdf" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc;">
                <small style="color: #64748b; font-size: 0.8rem; margin-top: 4px; display: block;">Maksimal ukuran file 10MB.</small>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Simpan Data</button>
                <a href="{{ route('admin.akreditasi-institusi.index') }}" style="padding: 10px 20px; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569; text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
