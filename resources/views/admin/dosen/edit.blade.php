@extends('admin.layouts.app')

@section('title', 'Edit Data Dosen')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Data Dosen</h1>
</div>

<div class="admin-card" style="max-width: 800px;">
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

        <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Informasi Perguruan Tinggi --}}
            <h3 style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">Informasi Perguruan Tinggi</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Kode PT</label>
                    <input type="text" name="kode_pt" value="{{ old('kode_pt', $dosen->kode_pt) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Nama PT</label>
                    <input type="text" name="nama_pt" value="{{ old('nama_pt', $dosen->nama_pt) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Fakultas</label>
                    <input type="text" name="fakultas" value="{{ old('fakultas', $dosen->fakultas) }}" placeholder="Contoh: Fakultas Teknik" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Prodi/Jurusan</label>
                    <input type="text" name="prodi_jurusan" value="{{ old('prodi_jurusan', $dosen->prodi_jurusan) }}" placeholder="Contoh: Teknik Informatika" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            {{-- Informasi Pribadi --}}
            <h3 style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">Informasi Pribadi</h3>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Nama Dosen (dengan Gelar) *</label>
                <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $dosen->tempat_lahir) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $dosen->tanggal_lahir ? \Carbon\Carbon::parse($dosen->tanggal_lahir)->format('Y-m-d') : '') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            {{-- Identitas & Nomor Registrasi --}}
            <h3 style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">Identitas & Nomor Registrasi</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">NUPTK</label>
                    <input type="text" name="nuptk" value="{{ old('nuptk', $dosen->nuptk) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">NIDN</label>
                    <input type="text" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">NIP</label>
                    <input type="text" name="nip" value="{{ old('nip', $dosen->nip) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik', $dosen->nik) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">TMMD</label>
                    <input type="text" name="tmmd" value="{{ old('tmmd', $dosen->tmmd) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            {{-- Status & Kepegawaian --}}
            <h3 style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">Status & Kepegawaian</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Status Kepegawaian *</label>
                    <select name="status_kepegawaian" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;" required>
                        <option value="PNS" {{ old('status_kepegawaian', $dosen->status_kepegawaian) == 'PNS' ? 'selected' : '' }}>PNS</option>
                        <option value="CPNS" {{ old('status_kepegawaian', $dosen->status_kepegawaian) == 'CPNS' ? 'selected' : '' }}>CPNS</option>
                        <option value="Pegawai Tetap Non PNS" {{ old('status_kepegawaian', $dosen->status_kepegawaian) == 'Pegawai Tetap Non PNS' ? 'selected' : '' }}>Pegawai Tetap Non PNS</option>
                        <option value="Kontrak" {{ old('status_kepegawaian', $dosen->status_kepegawaian) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Ikatan Kerja</label>
                    <select name="ikatan_kerja" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;">
                        <option value="">Pilih Ikatan Kerja</option>
                        <option value="Tetap" {{ old('ikatan_kerja', $dosen->ikatan_kerja) == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                        <option value="Tidak Tetap" {{ old('ikatan_kerja', $dosen->ikatan_kerja) == 'Tidak Tetap' ? 'selected' : '' }}>Tidak Tetap</option>
                        <option value="Kontrak" {{ old('ikatan_kerja', $dosen->ikatan_kerja) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Status Keaktifan</label>
                    <select name="status_keaktifan" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;">
                        <option value="">Pilih Status</option>
                        <option value="Aktif" {{ old('status_keaktifan', $dosen->status_keaktifan) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Non Aktif" {{ old('status_keaktifan', $dosen->status_keaktifan) == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                        <option value="Pensiun" {{ old('status_keaktifan', $dosen->status_keaktifan) == 'Pensiun' ? 'selected' : '' }}>Pensiun</option>
                        <option value="Meninggal" {{ old('status_keaktifan', $dosen->status_keaktifan) == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Pendidikan Terakhir</label>
                    <select name="pendidikan_terakhir" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;">
                        <option value="">Pilih Pendidikan</option>
                        <option value="S1" {{ old('pendidikan_terakhir', $dosen->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('pendidikan_terakhir', $dosen->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('pendidikan_terakhir', $dosen->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}>S3</option>
                        <option value="Sp-1" {{ old('pendidikan_terakhir', $dosen->pendidikan_terakhir) == 'Sp-1' ? 'selected' : '' }}>Sp-1</option>
                        <option value="Sp-2" {{ old('pendidikan_terakhir', $dosen->pendidikan_terakhir) == 'Sp-2' ? 'selected' : '' }}>Sp-2</option>
                        <option value="Profesi" {{ old('pendidikan_terakhir', $dosen->pendidikan_terakhir) == 'Profesi' ? 'selected' : '' }}>Profesi</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tahun Masuk</label>
                    <input type="text" name="tahun_masuk" value="{{ old('tahun_masuk', $dosen->tahun_masuk) }}" placeholder="Contoh: 2010" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tahun Lulus</label>
                    <input type="text" name="tahun_lulus" value="{{ old('tahun_lulus', $dosen->tahun_lulus) }}" placeholder="Contoh: 2015" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            {{-- Jabatan & Pangkat --}}
            <h3 style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">Jabatan & Pangkat Saat Ini</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Golongan</label>
                    <input type="text" name="golongan" value="{{ old('golongan', $dosen->golongan) }}" placeholder="Contoh: III/b" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Pangkat</label>
                    <input type="text" name="pangkat" value="{{ old('pangkat', $dosen->pangkat) }}" placeholder="Contoh: Penata Muda Tk. I" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Jabatan Fungsional</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $dosen->jabatan) }}" placeholder="Contoh: Lektor" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <h3 style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0; margin-top: 24px;">Riwayat Jabatan & Pangkat</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Jabatan Awal</label>
                    <input type="text" name="jabatan_awal" value="{{ old('jabatan_awal', $dosen->jabatan_awal) }}" placeholder="Contoh: Asisten Ahli" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">TMT Jabatan Awal</label>
                    <input type="date" name="tmt_jabatan_awal" value="{{ old('tmt_jabatan_awal', $dosen->tmt_jabatan_awal ? \Carbon\Carbon::parse($dosen->tmt_jabatan_awal)->format('Y-m-d') : '') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Jabatan Terakhir</label>
                    <input type="text" name="jabatan_terakhir" value="{{ old('jabatan_terakhir', $dosen->jabatan_terakhir) }}" placeholder="Contoh: Lektor" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">TMT Jabatan Terakhir</label>
                    <input type="date" name="tmt_jabatan_terakhir" value="{{ old('tmt_jabatan_terakhir', $dosen->tmt_jabatan_terakhir ? \Carbon\Carbon::parse($dosen->tmt_jabatan_terakhir)->format('Y-m-d') : '') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Pangkat Terakhir</label>
                    <input type="text" name="pangkat_terakhir" value="{{ old('pangkat_terakhir', $dosen->pangkat_terakhir) }}" placeholder="Contoh: Penata Muda Tk. I (III/b)" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">TMT Pangkat Terakhir</label>
                    <input type="date" name="tmt_pangkat_terakhir" value="{{ old('tmt_pangkat_terakhir', $dosen->tmt_pangkat_terakhir ? \Carbon\Carbon::parse($dosen->tmt_pangkat_terakhir)->format('Y-m-d') : '') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Masa Kerja Gol Tahun</label>
                    <input type="text" name="masa_kerja_gol_tahun" value="{{ old('masa_kerja_gol_tahun', $dosen->masa_kerja_gol_tahun) }}" placeholder="Contoh: 10" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Masa Kerja Gol Bulan</label>
                    <input type="text" name="masa_kerja_gol_bulan" value="{{ old('masa_kerja_gol_bulan', $dosen->masa_kerja_gol_bulan) }}" placeholder="Contoh: 6" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            {{-- Sertifikasi --}}
            <h3 style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">Sertifikasi</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Jenis Sertifikasi</label>
                    <input type="text" name="jenis_sertifikasi" value="{{ old('jenis_sertifikasi', $dosen->jenis_sertifikasi) }}" placeholder="Contoh: Serdos" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Tahun Sertifikasi</label>
                    <input type="text" name="tahun_sertifikasi" value="{{ old('tahun_sertifikasi', $dosen->tahun_sertifikasi) }}" placeholder="Contoh: 2020" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">Nomor Sertifikasi</label>
                    <input type="text" name="nomor_sertifikasi" value="{{ old('nomor_sertifikasi', $dosen->nomor_sertifikasi) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem;">SK Sertifikasi</label>
                    <input type="text" name="sk_sertifikasi" value="{{ old('sk_sertifikasi', $dosen->sk_sertifikasi) }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Simpan Perubahan</button>
                <a href="{{ route('admin.dosen.index') }}" style="padding: 10px 20px; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569; text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
