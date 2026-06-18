@extends('admin.layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <h1 class="page-title">Data Dosen</h1>
    <a href="{{ route('admin.dosen.create') }}" class="btn" style="width: auto; padding: 10px 16px;">+ Tambah Dosen</a>
</div>

@if(session('success'))
    <div style="padding: 12px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

<div class="admin-card">
    <div class="card-body" style="padding: 0; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; white-space: nowrap;">
            <thead>
                <tr style="background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem; position: sticky; left: 0; background: #f1f5f9; z-index: 1;">No</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Kode PT</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Nama PT</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Nama Dosen</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">NUPTK</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">NIDN</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Tempat Lahir</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Tanggal Lahir</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">NIP</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">NIK</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">TMMD</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Status Kepegawaian</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Ikatan Kerja</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Pendidikan Terakhir</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Tahun Masuk</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Tahun Lulus</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Jabatan Awal</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">TMT Jabatan Awal</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Jabatan Terakhir</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">TMT Jabatan Terakhir</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Pangkat Terakhir</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">TMT Pangkat Terakhir</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Masa Kerja Gol Tahun</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Masa Kerja Gol Bulan</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Jenis Sertifikasi</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Tahun Sertifikasi</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Nomor Sertifikasi</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">SK Sertifikasi</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem;">Status Keaktifan</th>
                    <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 0.8rem; text-align: right; position: sticky; right: 0; background: #f1f5f9; z-index: 1;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 10px 16px; font-size: 0.8rem; position: sticky; left: 0; background: #fff; z-index: 1;">{{ $index + 1 }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->kode_pt ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->nama_pt ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem; font-weight: 600; color: #0f172a;">{{ $item->nama }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->nuptk ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->nidn ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->tempat_lahir ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->nip ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->nik ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->tmmd ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">
                        <span style="background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 4px; font-weight: 600; font-size: 0.75rem;">{{ $item->status_kepegawaian ?? '-' }}</span>
                    </td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->ikatan_kerja ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->pendidikan_terakhir ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->tahun_masuk ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->tahun_lulus ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->jabatan_awal ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->tmt_jabatan_awal ? \Carbon\Carbon::parse($item->tmt_jabatan_awal)->format('d-m-Y') : '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->jabatan_terakhir ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->tmt_jabatan_terakhir ? \Carbon\Carbon::parse($item->tmt_jabatan_terakhir)->format('d-m-Y') : '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->pangkat_terakhir ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->tmt_pangkat_terakhir ? \Carbon\Carbon::parse($item->tmt_pangkat_terakhir)->format('d-m-Y') : '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->masa_kerja_gol_tahun ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->masa_kerja_gol_bulan ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->jenis_sertifikasi ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->tahun_sertifikasi ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->nomor_sertifikasi ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">{{ $item->sk_sertifikasi ?? '-' }}</td>
                    <td style="padding: 10px 16px; font-size: 0.8rem;">
                        @if($item->status_keaktifan == 'Aktif')
                            <span style="background: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 4px; font-weight: 600; font-size: 0.75rem;">{{ $item->status_keaktifan }}</span>
                        @elseif($item->status_keaktifan)
                            <span style="background: #fef2f2; color: #991b1b; padding: 2px 8px; border-radius: 4px; font-weight: 600; font-size: 0.75rem;">{{ $item->status_keaktifan }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td style="padding: 10px 16px; text-align: right; position: sticky; right: 0; background: #fff; z-index: 1;">
                        <div style="display: inline-flex; gap: 8px;">
                            <a href="{{ route('admin.dosen.edit', $item->id) }}" style="color: #2563eb; text-decoration: none; font-size: 0.8rem; font-weight: 500;">Edit</a>
                            <form action="{{ route('admin.dosen.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem; font-weight: 500;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="30" style="padding: 20px; text-align: center; color: #64748b; font-size: 0.875rem;">Belum ada data dosen.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
