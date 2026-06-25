@extends('admin.layouts.app')

@section('title', 'Detail Komitmen Mahasiswa')

@section('content')
<div class="page-header" style="display: flex; align-items: center; gap: 12px;">
    <a href="{{ route('admin.komitmen-mahasiswa.index') }}" style="color: #64748b; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; font-weight: 500; font-size: 0.875rem;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali ke Riwayat
    </a>
</div>

@if(session('success'))
    <div style="padding: 12px; background: #dcfce7; color: #166534; border-radius: 8px; margin: 10px 0 0; font-size: 0.875rem; font-weight: 500;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="padding: 12px; background: #fee2e2; color: #991b1b; border-radius: 8px; margin: 10px 0 0; font-size: 0.875rem; font-weight: 500;">
        {{ session('error') }}
    </div>
@endif

<div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 24px; align-items: start; margin-top: 10px;">
    
    <!-- Left Column: Detail Mahasiswa & Berkas -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        
        <!-- Detail Card -->
        <div class="admin-card">
            <div class="card-header" style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 0.95rem; color: #0f172a;">
                Identitas Mahasiswa
            </div>
            <div class="card-body" style="padding: 24px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
                    <div>
                        <div style="font-size: 0.72rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Nama Lengkap</div>
                        <div style="font-size: 0.95rem; font-weight: 600; color: #0f172a; margin-top: 4px;">{{ $item->nama }}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.72rem; color: #64748b; font-weight: 600; text-transform: uppercase;">NIM</div>
                        <div style="font-size: 0.95rem; font-weight: 600; color: #0f172a; margin-top: 4px;">{{ $item->nim }}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.72rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Program Studi</div>
                        <div style="font-size: 0.9rem; font-weight: 500; color: #334155; margin-top: 4px;">{{ $item->program_studi }}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.72rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Nomor WA</div>
                        <div style="font-size: 0.9rem; font-weight: 500; color: #334155; margin-top: 4px;">{{ $item->nomor_wa }}</div>
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid #e2e8f0; margin-bottom: 20px;">

                <div style="margin-bottom: 16px;">
                    <div style="font-size: 0.72rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Tindak Lanjut / Komitmen</div>
                    <div style="margin-top: 8px;">
                        @if($item->tindak_lanjut === 'Melanjutkan Studi')
                            <span style="display: inline-flex; align-items: center; gap: 6px; background: rgba(16,185,129,.1); color: #059669; padding: 8px 16px; border-radius: 10px; font-weight: 700; font-size: 0.88rem; border: 1px solid rgba(16,185,129,.2);">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                Melanjutkan Studi
                            </span>
                        @elseif($item->tindak_lanjut === 'Pindah PT')
                            <span style="display: inline-flex; align-items: center; gap: 6px; background: rgba(59,130,246,.1); color: #2563eb; padding: 8px 16px; border-radius: 10px; font-weight: 700; font-size: 0.88rem; border: 1px solid rgba(59,130,246,.2);">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                                Pindah PT
                            </span>
                        @else
                            <span style="display: inline-flex; align-items: center; gap: 6px; background: rgba(239,68,68,.1); color: #dc2626; padding: 8px 16px; border-radius: 10px; font-weight: 700; font-size: 0.88rem; border: 1px solid rgba(239,68,68,.2);">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Pengunduran Diri
                            </span>
                        @endif
                    </div>
                </div>

                <div>
                    <div style="font-size: 0.72rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Tanggal Pengajuan</div>
                    <div style="font-size: 0.9rem; font-weight: 500; color: #334155; margin-top: 4px;">{{ $item->created_at->format('d M Y, H:i') }} WIB</div>
                </div>
            </div>
        </div>

        <!-- Berkas Card -->
        <div class="admin-card">
            <div class="card-header" style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 0.95rem; color: #0f172a; display: flex; justify-content: space-between; align-items: center;">
                <span>Berkas Komitmen</span>
                @if($item->gdrive_pushed_at)
                    <span style="font-size: 0.72rem; font-weight: 600; color: #059669; background: rgba(16,185,129,.08); border: 1px solid rgba(16,185,129,.15); padding: 3px 10px; border-radius: 20px;">
                        ☁️ Tersimpan di Google Drive
                    </span>
                @endif
            </div>
            <div class="card-body" style="padding: 24px;">
                <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 20px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="width: 48px; height: 48px; background: rgba(59,130,246,.08); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <span style="font-size: 1.5rem;">{{ $item->gdrive_file_url ? '☁️' : '📄' }}</span>
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 700; font-size: 0.88rem; color: #1e293b;">Berkas Komitmen - {{ $item->tindak_lanjut }}</div>
                            <div style="font-size: 0.72rem; color: #64748b; margin-top: 2px; word-break: break-all; font-family: 'SF Mono', 'Monaco', monospace;">
                                {{ basename($item->file_path) }}
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        @if($item->gdrive_file_url)
                            <a href="{{ $item->gdrive_file_url }}" target="_blank" class="btn" style="flex: 1; padding: 10px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.82rem; background: linear-gradient(135deg, #059669, #047857); border-color: #059669;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                Buka di Google Drive
                            </a>
                        @else
                            <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn" style="flex: 1; padding: 10px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.82rem;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                Buka File
                            </a>
                            <a href="{{ asset('storage/' . $item->file_path) }}" download class="btn" style="background: #e2e8f0; color: #475569; border: 1.5px solid #cbd5e1; flex: 1; padding: 10px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.82rem;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Unduh
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Right Column: Status Update & GDrive -->
    <div style="display: flex; flex-direction: column; gap: 24px;">

        <!-- Status Update Card -->
        <div class="admin-card">
            <div class="card-header" style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 0.95rem; color: #0f172a;">
                Proses & Review
            </div>
            <div class="card-body" style="padding: 20px;">
                <form action="{{ route('admin.komitmen-mahasiswa.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 18px;">
                        <label style="display: block; font-size: 0.815rem; font-weight: 600; color: #334155; margin-bottom: 6px;">Status Pengajuan</label>
                        <select name="status" required style="width: 100%; padding: 10px; border: 1.5px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 0.875rem; background: white; cursor: pointer;">
                            <option value="menunggu" {{ old('status', $item->status) === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ old('status', $item->status) === 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ old('status', $item->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 0.815rem; font-weight: 600; color: #334155; margin-bottom: 6px;">Catatan Admin</label>
                        <textarea name="catatan_admin" placeholder="Tulis catatan atau feedback untuk mahasiswa..." style="width: 100%; min-height: 120px; padding: 10px; border: 1.5px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 0.875rem; font-family: inherit; resize: vertical;">{{ old('catatan_admin', $item->catatan_admin) }}</textarea>
                    </div>

                    <button type="submit" class="btn" style="width: 100%; padding: 12px; font-weight: 700; letter-spacing: 0.03em;">PERBARUI STATUS</button>
                </form>
            </div>
        </div>

        <!-- Google Drive Push Card -->
        <div class="admin-card">
            <div class="card-header" style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 0.95rem; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                Arsip Google Drive
            </div>
            <div class="card-body" style="padding: 20px;">

                @if($item->gdrive_pushed_at)
                    {{-- Sudah dipush --}}
                    <div style="text-align: center; padding: 10px 0;">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">✅</div>
                        <div style="font-weight: 700; color: #059669; font-size: 0.95rem; margin-bottom: 4px;">Sudah Diarsipkan</div>
                        <div style="font-size: 0.78rem; color: #64748b; margin-bottom: 16px;">
                            Dipush pada: {{ $item->gdrive_pushed_at->format('d M Y, H:i') }} WIB
                        </div>
                        <a href="{{ $item->gdrive_folder_url }}" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #059669, #047857); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 600; box-shadow: 0 2px 8px rgba(5,150,105,.2);">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            Buka Folder di Google Drive
                        </a>
                        <div style="margin-top: 12px; padding: 10px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; font-size: 0.75rem; color: #166534;">
                            File lokal telah dihapus dari server untuk menghemat storage.
                        </div>
                    </div>

                @elseif($item->status === 'selesai')
                    {{-- Status selesai, belum dipush --}}
                    @if(!$gdriveConnected)
                        <div style="text-align: center; padding: 10px 0;">
                            <div style="font-size: 2rem; margin-bottom: 10px;">⚠️</div>
                            <div style="font-weight: 600; color: #d97706; font-size: 0.88rem; margin-bottom: 8px;">Google Drive Belum Terhubung</div>
                            <div style="font-size: 0.78rem; color: #64748b; margin-bottom: 16px;">Authorize terlebih dahulu agar dapat mengarsipkan berkas.</div>
                            <a href="{{ route('admin.google.auth') }}" style="display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 600; box-shadow: 0 2px 8px rgba(37,99,235,.2);">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                                Hubungkan Google Drive
                            </a>
                        </div>
                    @else
                        <div style="text-align: center; padding: 10px 0;">
                            <div style="font-size: 2rem; margin-bottom: 10px;">📤</div>
                            <div style="font-weight: 600; color: #334155; font-size: 0.88rem; margin-bottom: 4px;">Siap Diarsipkan</div>
                            <div style="font-size: 0.78rem; color: #64748b; margin-bottom: 16px;">
                                Berkas komitmen akan diunggah ke Google Drive dan dihapus dari server lokal.
                            </div>
                            <form action="{{ route('admin.komitmen-mahasiswa.push-gdrive', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin push berkas ke Google Drive?\n\nSetelah proses ini:\n✅ Berkas akan tersimpan di Google Drive\n🗑️ File lokal akan dihapus dari server\n\nProses ini tidak dapat dibatalkan.')">
                                @csrf
                                <button type="submit" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #059669, #047857); color: white; padding: 12px 28px; border-radius: 10px; border: none; font-family: inherit; font-size: 0.9rem; font-weight: 700; cursor: pointer; box-shadow: 0 4px 14px rgba(5,150,105,.25); transition: all .25s; letter-spacing: 0.02em;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                    PUSH KE GOOGLE DRIVE
                                </button>
                            </form>
                        </div>
                    @endif

                @else
                    {{-- Status belum selesai --}}
                    <div style="text-align: center; padding: 16px 0;">
                        <div style="font-size: 2rem; margin-bottom: 10px; opacity: 0.4;">☁️</div>
                        <div style="font-weight: 500; color: #94a3b8; font-size: 0.85rem; line-height: 1.5;">
                            Fitur arsip Google Drive hanya tersedia setelah status pengajuan diubah menjadi <strong>"Selesai"</strong>.
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>

</div>
@endsection
