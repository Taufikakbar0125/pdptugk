@extends('admin.layouts.app')

@section('title', 'Daftar Pengajuan Validasi')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
    <h1 class="page-title" style="margin: 0;">Daftar Pengajuan Validasi</h1>
    
    <!-- Filter and Search -->
    <form method="GET" action="{{ route('admin.pengajuan-validasi.index') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
        <select name="status" style="padding: 8px 12px; border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.875rem; outline: none; background: white; cursor: pointer;">
            <option value="">-- Semua Status --</option>
            <option value="data di terima" {{ request('status') === 'data di terima' ? 'selected' : '' }}>Data Di Terima</option>
            <option value="data di tinjau" {{ request('status') === 'data di tinjau' ? 'selected' : '' }}>Data Di Tinjau</option>
            <option value="data dikembalikan untuk diperbarui" {{ request('status') === 'data dikembalikan untuk diperbarui' ? 'selected' : '' }}>Data Dikembalikan</option>
            <option value="data di proses" {{ request('status') === 'data di proses' ? 'selected' : '' }}>Data Di Proses</option>
            <option value="pengajuan selesai" {{ request('status') === 'pengajuan selesai' ? 'selected' : '' }}>Pengajuan Selesai</option>
        </select>

        <input type="text" name="search" placeholder="Cari Nama atau NIM..." value="{{ request('search') }}" style="padding: 8px 12px; border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.875rem; outline: none; width: 200px;">
        
        <button type="submit" class="btn" style="width: auto; padding: 8px 16px;">Filter</button>
        @if(request()->filled('status') || request()->filled('search'))
            <a href="{{ route('admin.pengajuan-validasi.index') }}" style="font-size: 0.875rem; color: #64748b; text-decoration: none; padding: 8px 4px;">Reset</a>
        @endif
    </form>
</div>

@if(session('success'))
    <div style="padding: 12px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

<div class="admin-card">
    <div class="card-body" style="padding: 0; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
                    <th style="padding: 14px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Mahasiswa</th>
                    <th style="padding: 14px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Program Studi</th>
                    <th style="padding: 14px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Kategori Masalah</th>
                    <th style="padding: 14px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Tanggal</th>
                    <th style="padding: 14px 20px; font-weight: 600; color: #475569; font-size: 0.875rem; text-align: center;">Status</th>
                    <th style="padding: 14px 20px; font-weight: 600; color: #475569; font-size: 0.875rem; text-align: right; width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 16px 20px; font-size: 0.875rem;">
                        <div style="font-weight: 600; color: #0f172a;">{{ $item->nama }}</div>
                        <div style="font-size: 0.75rem; color: #64748b; margin-top: 2px;">NIM: {{ $item->nim }}</div>
                    </td>
                    <td style="padding: 16px 20px; font-size: 0.875rem; color: #334155;">
                        <div>{{ $item->prodi }}</div>
                        <div style="font-size: 0.75rem; color: #64748b; margin-top: 2px;">{{ $item->fakultas }} &middot; Angkatan {{ $item->angkatan }}</div>
                    </td>
                    <td style="padding: 16px 20px; font-size: 0.875rem; font-weight: 500; color: #2563eb;">
                        {{ $item->jenisMasalah->nama_masalah ?? 'Kategori Dihapus' }}
                    </td>
                    <td style="padding: 16px 20px; font-size: 0.875rem; color: #475569;">
                        <div>{{ $item->created_at->format('d M Y') }}</div>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 2px;">{{ $item->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td style="padding: 16px 20px; font-size: 0.875rem; text-align: center;">
                        @if ($item->status === 'data di terima')
                            <span style="background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">Di Terima</span>
                        @elseif ($item->status === 'data di tinjau')
                            <span style="background: #fef3c7; color: #d97706; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">Di Tinjau</span>
                        @elseif ($item->status === 'data dikembalikan untuk diperbarui')
                            <span style="background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">Dikembalikan</span>
                        @elseif ($item->status === 'data di proses')
                            <span style="background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">Di Proses</span>
                        @elseif ($item->status === 'pengajuan selesai')
                            <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">Selesai</span>
                        @else
                            <span style="background: #e2e8f0; color: #64748b; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">{{ $item->status }}</span>
                        @endif
                    </td>
                    <td style="padding: 16px 20px; text-align: right;">
                        <a href="{{ route('admin.pengajuan-validasi.show', $item->id) }}" class="btn" style="width: auto; padding: 6px 12px; font-size: 0.78rem; text-decoration: none; display: inline-block;">Proses / Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 30px; text-align: center; color: #64748b; font-size: 0.875rem;">Belum ada pengajuan validasi data masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($items->hasPages())
    <div style="margin-top: 20px; display: flex; justify-content: center;">
        {{ $items->links() }}
    </div>
@endif
@endsection
