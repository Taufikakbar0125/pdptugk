@extends('admin.layouts.app')

@section('title', 'Data Akreditasi Internasional')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <h1 class="page-title">Akreditasi Internasional</h1>
    <a href="{{ route('admin.akreditasi-internasional.create') }}" class="btn" style="width: auto; padding: 10px 16px;">+ Tambah Data</a>
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
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Jenis</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Prodi & Fakultas</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Strata</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Period</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Status</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px 20px; font-size: 0.875rem;">
                        <span style="background: {{ $item->jenis == 'ASIC' ? '#fef08a' : '#fed7aa' }}; color: #9a3412; padding: 2px 8px; border-radius: 4px; font-weight: 600;">{{ $item->jenis }}</span>
                    </td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">
                        <div style="font-weight: 600; color: #0f172a;">{{ $item->prodi }}</div>
                        <div style="font-size: 0.75rem; color: #64748b; margin-top: 2px;">{{ $item->fakultas }}</div>
                    </td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ $item->strata }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ $item->period }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ $item->status }}</td>
                    <td style="padding: 12px 20px; text-align: right;">
                        <div style="display: inline-flex; gap: 8px;">
                            <a href="{{ route('admin.akreditasi-internasional.edit', $item->id) }}" style="color: #2563eb; text-decoration: none; font-size: 0.875rem; font-weight: 500;">Edit</a>
                            <form action="{{ route('admin.akreditasi-internasional.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.875rem; font-weight: 500;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #64748b; font-size: 0.875rem;">Belum ada data akreditasi internasional.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
