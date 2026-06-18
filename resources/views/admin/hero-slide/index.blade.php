@extends('admin.layouts.app')

@section('title', 'Hero Slider')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <h1 class="page-title">Hero Slider</h1>
    <a href="{{ route('admin.hero-slide.create') }}" class="btn" style="width: auto; padding: 10px 16px;">+ Tambah Slide</a>
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
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Preview</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Judul</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Status</th>
                    <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px 20px; font-size: 0.875rem;">{{ $item->order_num }}</td>
                    <td style="padding: 12px 20px;">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}"
                             style="width: 120px; height: 68px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;"
                             loading="lazy">
                    </td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">
                        <b>{{ $item->title ?: '(Tanpa judul)' }}</b>
                    </td>
                    <td style="padding: 12px 20px; font-size: 0.875rem;">
                        @if($item->is_active)
                            <span style="background: #dcfce7; color: #166534; padding: 2px 10px; border-radius: 4px; font-weight: 600; font-size: 0.8rem;">Aktif</span>
                        @else
                            <span style="background: #fee2e2; color: #991b1b; padding: 2px 10px; border-radius: 4px; font-weight: 600; font-size: 0.8rem;">Nonaktif</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px; text-align: right;">
                        <div style="display: inline-flex; gap: 8px;">
                            <a href="{{ route('admin.hero-slide.edit', $item->id) }}" style="color: #2563eb; text-decoration: none; font-size: 0.875rem; font-weight: 500;">Edit</a>
                            <form action="{{ route('admin.hero-slide.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus slide ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.875rem; font-weight: 500;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 20px; text-align: center; color: #64748b; font-size: 0.875rem;">Belum ada slide yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
