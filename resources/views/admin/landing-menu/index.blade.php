@extends('admin.layouts.app')

@section('title', 'Kelola Landing Portal')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <h1 class="page-title">Kelola Landing Portal (Globe)</h1>
    <a href="{{ route('admin.landing-menu.create') }}" class="btn" style="width: auto; padding: 10px 16px;">+ Tambah Globe</a>
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
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Urutan</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Nama Menu</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Ikon</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">URL Tujuan</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Tema Warna</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ $item->order_num }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;"><b>{{ $item->name }}</b></td>
                    <td style="padding: 12px 20px; font-size: 1.2rem;">{{ $item->icon }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem; color:#2563eb;">{{ $item->url }}</td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">
                        <span style="background: #e2e8f0; padding: 2px 8px; border-radius: 4px; font-weight: 600;">{{ ucfirst($item->theme) }}</span>
                    </td>
                    <td style="padding: 12px 20px; text-align: right;">
                        <div style="display: inline-flex; gap: 8px;">
                            <a href="{{ route('admin.landing-menu.edit', $item->id) }}" style="color: #2563eb; text-decoration: none; font-size: 0.875rem; font-weight: 500;">Edit</a>
                            <form action="{{ route('admin.landing-menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus planet ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.875rem; font-weight: 500;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #64748b; font-size: 0.875rem;">Belum ada menu portal yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
