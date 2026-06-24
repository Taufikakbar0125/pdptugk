@extends('admin.layouts.app')

@section('title', 'Data Akreditasi Institusi')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <h1 class="page-title">Akreditasi Institusi</h1>
    <a href="{{ route('admin.akreditasi-institusi.create') }}" class="btn" style="width: auto; padding: 10px 16px;">+ Tambah Data</a>
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
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">No SK</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Peringkat</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Tanggal Akreditasi</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Kadaluarsa</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Status</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ $item->no_sk }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">
                        <span style="background: #dbeafe; color: #1e40af; padding: 2px 8px; border-radius: 4px; font-weight: 600;">{{ $item->peringkat }}</span>
                    </td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ $item->tanggal_akreditasi ? \Carbon\Carbon::parse($item->tanggal_akreditasi)->format('d/m/Y') : '-' }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('d/m/Y') }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ $item->status }}</td>
                    <td style="padding: 12px 20px; text-align: right;">
                        <div style="display: inline-flex; gap: 8px;">
                            <a href="{{ route('admin.akreditasi-institusi.edit', $item->id) }}" style="color: #2563eb; text-decoration: none; font-size: 0.875rem; font-weight: 500;">Edit</a>
                            <form action="{{ route('admin.akreditasi-institusi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.875rem; font-weight: 500;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #64748b; font-size: 0.875rem;">Belum ada data akreditasi institusi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
