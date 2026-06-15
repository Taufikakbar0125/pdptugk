@extends('admin.layouts.app')

@section('title', 'Tambah Data Dosen')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Data Dosen</h1>
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

        <form action="{{ route('admin.dosen.store') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Nama Lengkap (dengan Gelar)</label>
                <input type="text" name="nama" value="{{ old('nama') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Fakultas / Unit Kerja</label>
                <input type="text" name="fakultas" value="{{ old('fakultas') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">NIP (Opsional)</label>
                    <input type="text" name="nip" value="{{ old('nip') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">NIDN (Opsional)</label>
                    <input type="text" name="nidn" value="{{ old('nidn') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Golongan (Opsional)</label>
                    <input type="text" name="golongan" value="{{ old('golongan') }}" placeholder="Contoh: III/b" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Pangkat (Opsional)</label>
                    <input type="text" name="pangkat" value="{{ old('pangkat') }}" placeholder="Contoh: Penata Muda Tk. I" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Jabatan Fungsional</label>
                <input type="text" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Asisten Ahli" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Status Kepegawaian</label>
                <select name="status_kepegawaian" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                    <option value="">Pilih Status</option>
                    <option value="PNS" {{ old('status_kepegawaian') == 'PNS' ? 'selected' : '' }}>PNS</option>
                    <option value="CPNS" {{ old('status_kepegawaian') == 'CPNS' ? 'selected' : '' }}>CPNS</option>
                    <option value="Pegawai Tetap Non PNS" {{ old('status_kepegawaian') == 'Pegawai Tetap Non PNS' ? 'selected' : '' }}>Pegawai Tetap Non PNS</option>
                    <option value="Kontrak" {{ old('status_kepegawaian') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                </select>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Simpan Data</button>
                <a href="{{ route('admin.dosen.index') }}" style="padding: 10px 20px; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569; text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
