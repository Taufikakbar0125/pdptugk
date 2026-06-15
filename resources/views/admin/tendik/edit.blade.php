@extends('admin.layouts.app')

@section('title', 'Edit Data Tendik')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Data Tendik</h1>
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

        <form action="{{ route('admin.tendik.update', $tendik->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Nama Lengkap (dengan Gelar)</label>
                <input type="text" name="nama" value="{{ old('nama', $tendik->nama) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Unit Kerja</label>
                <input type="text" name="unit_kerja" value="{{ old('unit_kerja', $tendik->unit_kerja) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">NIP (Opsional)</label>
                <input type="text" name="nip" value="{{ old('nip', $tendik->nip) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Golongan (Opsional)</label>
                    <input type="text" name="golongan" value="{{ old('golongan', $tendik->golongan) }}" placeholder="Contoh: III/b" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Pangkat (Opsional)</label>
                    <input type="text" name="pangkat" value="{{ old('pangkat', $tendik->pangkat) }}" placeholder="Contoh: Penata Muda Tk. I" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Jabatan</label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $tendik->jabatan) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Status Kepegawaian</label>
                <select name="status_kepegawaian" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                    <option value="PNS" {{ old('status_kepegawaian', $tendik->status_kepegawaian) == 'PNS' ? 'selected' : '' }}>PNS</option>
                    <option value="CPNS" {{ old('status_kepegawaian', $tendik->status_kepegawaian) == 'CPNS' ? 'selected' : '' }}>CPNS</option>
                    <option value="Kontrak" {{ old('status_kepegawaian', $tendik->status_kepegawaian) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                </select>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Simpan Perubahan</button>
                <a href="{{ route('admin.tendik.index') }}" style="padding: 10px 20px; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569; text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
