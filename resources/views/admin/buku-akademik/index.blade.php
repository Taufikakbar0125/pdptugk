@extends('admin.layouts.app')

@section('title', 'Data Buku Informasi Akademik')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <h1 class="page-title">Buku Informasi Akademik</h1>
    <a href="{{ route('admin.buku-akademik.create') }}" class="btn" style="width: auto; padding: 10px 16px;">+ Tambah Buku</a>
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
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Judul Buku</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Semester</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Tahun Akademik</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">File Dokumen</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px 20px; font-size: 0.875rem; font-weight: 500; color: #0f172a;">{{ $item->judul }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">
                        <span style="background: {{ $item->semester == 'Gasal' ? '#dbeafe' : '#dcfce7' }}; color: {{ $item->semester == 'Gasal' ? '#1e40af' : '#166534' }}; padding: 2px 8px; border-radius: 4px; font-weight: 600;">{{ $item->semester }}</span>
                    </td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ $item->tahun_akademik }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">
                        @if($item->file_path)
                            <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" style="color: #2563eb; text-decoration: none; font-weight: 500;">Lihat File ({{ $item->file_size }})</a>
                        @else
                            <span style="color: #94a3b8;">Tidak ada file</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px; text-align: right;">
                        <div style="display: inline-flex; gap: 8px;">
                            <a href="{{ route('admin.buku-akademik.edit', $item->id) }}" style="color: #2563eb; text-decoration: none; font-size: 0.875rem; font-weight: 500;">Edit</a>
                            <form action="{{ route('admin.buku-akademik.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.875rem; font-weight: 500;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 20px; text-align: center; color: #64748b; font-size: 0.875rem;">Belum ada buku informasi akademik.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
