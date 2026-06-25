@extends('admin.layouts.app')

@section('title', 'Riwayat Komitmen Mahasiswa')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
    <h1 class="page-title" style="margin: 0;">Riwayat Komitmen Mahasiswa</h1>
    
    <!-- Filter and Search -->
    <form method="GET" action="{{ route('admin.komitmen-mahasiswa.index') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
        <select name="status" style="padding: 8px 12px; border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.875rem; outline: none; background: white; cursor: pointer;">
            <option value="">-- Semua Status --</option>
            <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <input type="text" name="search" placeholder="Cari Nama atau NIM..." value="{{ request('search') }}" style="padding: 8px 12px; border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.875rem; outline: none; width: 200px;">
        
        <button type="submit" class="btn" style="width: auto; padding: 8px 16px;">Filter</button>
        @if(request()->filled('status') || request()->filled('search'))
            <a href="{{ route('admin.komitmen-mahasiswa.index') }}" style="font-size: 0.875rem; color: #64748b; text-decoration: none; padding: 8px 4px;">Reset</a>
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
                    <th style="padding: 14px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Tindak Lanjut</th>
                    <th style="padding: 14px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Nomor WA</th>
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
                        {{ $item->program_studi }}
                    </td>
                    <td style="padding: 16px 20px; font-size: 0.875rem;">
                        @if($item->tindak_lanjut === 'Melanjutkan Studi')
                            <span style="display: inline-flex; align-items: center; gap: 5px; background: rgba(16,185,129,.08); color: #059669; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; white-space: nowrap;">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                Melanjutkan Studi
                            </span>
                        @elseif($item->tindak_lanjut === 'Pindah PT')
                            <span style="display: inline-flex; align-items: center; gap: 5px; background: rgba(59,130,246,.08); color: #2563eb; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; white-space: nowrap;">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 18l6-6-6-6"/></svg>
                                Pindah PT
                            </span>
                        @else
                            <span style="display: inline-flex; align-items: center; gap: 5px; background: rgba(239,68,68,.08); color: #dc2626; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; white-space: nowrap;">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Pengunduran Diri
                            </span>
                        @endif
                    </td>
                    <td style="padding: 16px 20px; font-size: 0.85rem; color: #475569;">
                        {{ $item->nomor_wa }}
                    </td>
                    <td style="padding: 16px 20px; font-size: 0.875rem; color: #475569;">
                        <div>{{ $item->created_at->format('d M Y') }}</div>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 2px;">{{ $item->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td style="padding: 16px 20px; font-size: 0.875rem; text-align: center;">
                        @if ($item->status === 'menunggu')
                            <span style="background: #fef3c7; color: #d97706; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">Menunggu</span>
                        @elseif ($item->status === 'diproses')
                            <span style="background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">Diproses</span>
                        @elseif ($item->status === 'selesai')
                            <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">Selesai</span>
                        @else
                            <span style="background: #e2e8f0; color: #64748b; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;">{{ $item->status }}</span>
                        @endif
                    </td>
                    <td style="padding: 16px 20px; text-align: right;">
                        <a href="{{ route('admin.komitmen-mahasiswa.show', $item->id) }}" class="btn" style="width: auto; padding: 6px 12px; font-size: 0.78rem; text-decoration: none; display: inline-block;">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 30px; text-align: center; color: #64748b; font-size: 0.875rem;">Belum ada pengajuan komitmen mahasiswa.</td>
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
