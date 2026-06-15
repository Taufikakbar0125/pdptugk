@extends('admin.layouts.app')

@section('title', 'Edit Akreditasi Prodi')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Akreditasi Prodi</h1>
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

        <form action="{{ route('admin.akreditasi-prodi.update', $akreditasi_prodi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Fakultas</label>
                <input type="text" name="fakultas" value="{{ $akreditasi_prodi->fakultas }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Program Studi</label>
                <input type="text" name="prodi" value="{{ $akreditasi_prodi->prodi }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Strata</label>
                    <select name="strata" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                        <option value="">Pilih Strata</option>
                        <option value="D3" {{ $akreditasi_prodi->strata == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="S1" {{ $akreditasi_prodi->strata == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ $akreditasi_prodi->strata == 'S2' ? 'selected' : '' }}>S2</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Peringkat Akreditasi</label>
                    <select name="peringkat" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                        <option value="">Pilih Peringkat</option>
                        <option value="Unggul" {{ $akreditasi_prodi->peringkat == 'Unggul' ? 'selected' : '' }}>Unggul</option>
                        <option value="Baik Sekali" {{ $akreditasi_prodi->peringkat == 'Baik Sekali' ? 'selected' : '' }}>Baik Sekali</option>
                        <option value="Baik" {{ $akreditasi_prodi->peringkat == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="A" {{ $akreditasi_prodi->peringkat == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $akreditasi_prodi->peringkat == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ $akreditasi_prodi->peringkat == 'C' ? 'selected' : '' }}>C</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Nomor Sertifikat</label>
                <input type="text" name="no_sertifikat" value="{{ $akreditasi_prodi->no_sertifikat }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Penyelenggaraan</label>
                <input type="text" name="penyelenggaraan" value="{{ $akreditasi_prodi->penyelenggaraan }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tanggal Akreditasi</label>
                    <input type="date" name="tanggal_akreditasi" value="{{ $akreditasi_prodi->tanggal_akreditasi ? \Carbon\Carbon::parse($akreditasi_prodi->tanggal_akreditasi)->format('Y-m-d') : '' }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tanggal Kadaluarsa</label>
                    <input type="date" name="tanggal_kadaluarsa" value="{{ $akreditasi_prodi->tanggal_kadaluarsa ? \Carbon\Carbon::parse($akreditasi_prodi->tanggal_kadaluarsa)->format('Y-m-d') : '' }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Status</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                    <option value="Aktif" {{ $akreditasi_prodi->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Kadaluarsa" {{ $akreditasi_prodi->status == 'Kadaluarsa' ? 'selected' : '' }}>Kadaluarsa</option>
                </select>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">File Sertifikat (PDF)</label>
                @if($akreditasi_prodi->file_pdf)
                    <div style="margin-bottom: 8px;">
                        <a href="{{ Storage::url($akreditasi_prodi->file_pdf) }}" target="_blank" style="color: #2563eb; text-decoration: none; font-size: 0.875rem;">📄 Lihat PDF Tersimpan</a>
                    </div>
                @endif
                <input type="file" name="file_pdf" accept=".pdf" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc;">
                <small style="color: #64748b; font-size: 0.8rem; margin-top: 4px; display: block;">Maksimal ukuran file 10MB. Kosongkan jika tidak ingin mengubah file.</small>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Simpan Perubahan</button>
                <a href="{{ route('admin.akreditasi-prodi.index') }}" style="padding: 10px 20px; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569; text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
