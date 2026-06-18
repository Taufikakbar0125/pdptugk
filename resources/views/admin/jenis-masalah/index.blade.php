@extends('admin.layouts.app')

@section('title', 'Kelola Kategori Masalah')

@section('content')
<div class="page-header">
    <h1 class="page-title">Kelola Kategori Masalah & Berkas Pendukung</h1>
</div>

@if(session('success'))
    <div style="padding: 12px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="padding: 12px; background: #fee2e2; color: #991b1b; border-radius: 8px; margin-bottom: 20px;">
        {{ $errors->first() }}
    </div>
@endif

<div style="display: grid; grid-template-columns: 1.4fr 1.1fr; gap: 24px; align-items: start;">
    
    <!-- Left Card: List Kategori & Berkas -->
    <div class="admin-card">
        <div class="card-header" style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 0.95rem; color: #0f172a;">
            Daftar Kategori Masalah & Syarat Berkas
        </div>
        <div class="card-body" style="padding: 0; overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem; width: 60px;">No</th>
                        <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Nama Kategori Masalah</th>
                        <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem;">Persyaratan Dokumen Pendukung</th>
                        <th style="padding: 12px 20px; font-weight: 600; color: #475569; font-size: 0.875rem; text-align: right; width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 16px 20px; font-size: 0.875rem; color: #64748b; vertical-align: top;">
                            {{ $index + 1 }}
                        </td>
                        <td style="padding: 16px 20px; font-size: 0.875rem; font-weight: 600; color: #0f172a; vertical-align: top;">
                            {{ $item->nama_masalah }}
                        </td>
                        <td style="padding: 16px 20px; font-size: 0.82rem; color: #475569; line-height: 1.5; vertical-align: top;">
                            <ul style="padding-left: 16px; margin: 0;">
                                @forelse($item->dokumenPersyaratans as $doc)
                                    <li style="margin-bottom: 4px;">
                                        {{ $doc->nama_dokumen }}
                                        @if($doc->is_wajib)
                                            <span style="color: #ef4444; font-weight: 800; font-size: 0.72rem; background: #fee2e2; padding: 1px 6px; border-radius: 4px; margin-left: 4px;">Wajib</span>
                                        @else
                                            <span style="color: #64748b; font-size: 0.72rem; background: #f1f5f9; padding: 1px 6px; border-radius: 4px; margin-left: 4px;">Opsional</span>
                                        @endif
                                    </li>
                                @empty
                                    <li style="color: #94a3b8; font-style: italic; list-style: none; margin-left: -16px;">Tidak butuh berkas</li>
                                @endforelse
                            </ul>
                        </td>
                        <td style="padding: 16px 20px; text-align: right; vertical-align: top;">
                            <div style="display: inline-flex; gap: 12px;">
                                <a href="{{ route('admin.jenis-masalah.index', ['edit_id' => $item->id]) }}" style="color: #2563eb; text-decoration: none; font-size: 0.875rem; font-weight: 500;">Edit</a>
                                <form action="{{ route('admin.jenis-masalah.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori masalah ini? Semua data pengajuan mahasiswa terkait kategori ini akan terhapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.875rem; font-weight: 500; padding: 0;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 20px; text-align: center; color: #64748b; font-size: 0.875rem;">Belum ada kategori masalah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Card: Form Tambah / Edit -->
    <div class="admin-card">
        @if(request()->has('edit_id') && $editItem = $items->firstWhere('id', request('edit_id')))
            <!-- Edit Form -->
            <div class="card-header" style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 0.95rem; color: #0f172a; display: flex; justify-content: space-between; align-items: center;">
                <span>Edit Kategori Masalah</span>
                <a href="{{ route('admin.jenis-masalah.index') }}" style="font-size: 0.75rem; color: #64748b; text-decoration: none;">Batal</a>
            </div>
            <div class="card-body" style="padding: 20px;">
                <form action="{{ route('admin.jenis-masalah.update', $editItem->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 0.815rem; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Kategori Masalah</label>
                        <input type="text" name="nama_masalah" value="{{ old('nama_masalah', $editItem->nama_masalah) }}" required style="width: 100%; padding: 10px; border: 1.5px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 0.875rem;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <label style="font-size: 0.815rem; font-weight: 600; color: #334155;">Daftar Dokumen Pendukung</label>
                            <button type="button" onclick="addDocRow('edit-rows-container')" style="background: #e0f2fe; color: #0369a1; border: none; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">+ Tambah Berkas</button>
                        </div>

                        <div id="edit-rows-container" style="display: flex; flex-direction: column; gap: 8px;">
                            @foreach($editItem->dokumenPersyaratans as $idx => $doc)
                                <div class="doc-row" style="display: flex; gap: 8px; align-items: center;">
                                    <input type="text" name="docs[{{ $idx }}][nama]" value="{{ $doc->nama_dokumen }}" placeholder="Contoh: SCAN KTP" required style="flex: 1; padding: 8px; border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.82rem;">
                                    
                                    <label style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.78rem; cursor: pointer;">
                                        <input type="checkbox" name="docs[{{ $idx }}][is_wajib]" value="1" {{ $doc->is_wajib ? 'checked' : '' }}>
                                        Wajib
                                    </label>
                                    
                                    <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; font-size: 0.78rem; cursor: pointer; padding: 4px 6px;">Hapus</button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn" style="width: 100%; padding: 12px; font-weight: 700;">SIMPAN PERUBAHAN</button>
                </form>
            </div>
        @else
            <!-- Create Form -->
            <div class="card-header" style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 0.95rem; color: #0f172a;">
                Tambah Kategori Masalah Baru
            </div>
            <div class="card-body" style="padding: 20px;">
                <form action="{{ route('admin.jenis-masalah.store') }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 0.815rem; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Kategori Masalah</label>
                        <input type="text" name="nama_masalah" placeholder="Contoh: Perubahan Nama" value="{{ old('nama_masalah') }}" required style="width: 100%; padding: 10px; border: 1.5px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 0.875rem;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <label style="font-size: 0.815rem; font-weight: 600; color: #334155;">Daftar Dokumen Pendukung</label>
                            <button type="button" onclick="addDocRow('create-rows-container')" style="background: #e0f2fe; color: #0369a1; border: none; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">+ Tambah Berkas</button>
                        </div>

                        <div id="create-rows-container" style="display: flex; flex-direction: column; gap: 8px;">
                            <div class="doc-row" style="display: flex; gap: 8px; align-items: center;">
                                <input type="text" name="docs[0][nama]" placeholder="Contoh: SCAN KTP Asli" required style="flex: 1; padding: 8px; border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.82rem;">
                                
                                <label style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.78rem; cursor: pointer;">
                                    <input type="checkbox" name="docs[0][is_wajib]" value="1" checked>
                                    Wajib
                                </label>
                                
                                <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; font-size: 0.78rem; cursor: pointer; padding: 4px 6px;">Hapus</button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn" style="width: 100%; padding: 12px; font-weight: 700;">TAMBAH KATEGORI</button>
                </form>
            </div>
        @endif
    </div>

</div>

<script>
    let rowIndex = 100; // Mulai index tinggi biar aman ga bentrok sama default seeder
    
    function addDocRow(containerId) {
        const container = document.getElementById(containerId);
        rowIndex++;
        
        const row = document.createElement('div');
        row.className = 'doc-row';
        row.style.display = 'flex';
        row.style.gap = '8px';
        row.style.alignItems = 'center';
        
        row.innerHTML = `
            <input type="text" name="docs[${rowIndex}][nama]" placeholder="Contoh: SCAN KK Asli" required style="flex: 1; padding: 8px; border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.82rem;">
            <label style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.78rem; cursor: pointer;">
                <input type="checkbox" name="docs[${rowIndex}][is_wajib]" value="1" checked>
                Wajib
            </label>
            <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; font-size: 0.78rem; cursor: pointer; padding: 4px 6px;">Hapus</button>
        `;
        
        container.appendChild(row);
    }
</script>
@endsection
