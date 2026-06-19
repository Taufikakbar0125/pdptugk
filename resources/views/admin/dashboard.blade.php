@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .dash-greeting-card {
        background: linear-gradient(135deg, #6366f1 0%, #818cf8 50%, #a78bfa 100%);
        border-radius: 20px;
        padding: 36px 40px;
        color: #fff;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }
    .dash-greeting-card::before {
        content: '';
        position: absolute;
        top: -60%; right: -10%;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);
        border-radius: 50%;
    }
    .dash-greeting-card::after {
        content: '';
        position: absolute;
        bottom: -40%; left: 10%;
        width: 200px; height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        border-radius: 50%;
    }
    .dash-greeting-title {
        position: relative; z-index: 1;
        font-size: 1.6rem;
        font-weight: 800;
        margin-bottom: 6px;
        letter-spacing: -0.02em;
    }
    .dash-greeting-sub {
        position: relative; z-index: 1;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.75);
        max-width: 500px;
        line-height: 1.5;
    }

    .dash-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-icon.primary { background: rgba(99, 102, 241, 0.08); color: #6366f1; }
    .stat-icon.success { background: rgba(16, 185, 129, 0.08); color: #10b981; }
    .stat-icon.warning { background: rgba(245, 158, 11, 0.08); color: #f59e0b; }
    .stat-icon.purple  { background: rgba(168, 85, 247, 0.08); color: #a855f7; }
    .stat-icon.rose    { background: rgba(244, 63, 94, 0.08);  color: #f43f5e; }

    .stat-info { flex: 1; }
    .stat-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 4px;
    }
    .stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
        letter-spacing: -0.02em;
    }

    .dash-charts {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }
    .chart-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px;
        border: 1px solid rgba(226, 232, 240, 0.6);
    }
    .chart-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 16px;
        letter-spacing: -0.01em;
    }

    .section-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 16px;
        letter-spacing: -0.01em;
    }

    .quick-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 16px;
    }
    .quick-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 20px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        display: flex;
        align-items: flex-start;
        gap: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .quick-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.06);
    }
    .quick-card-icon {
        width: 40px; height: 40px;
        background: #f8fafc;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #64748b;
        flex-shrink: 0;
    }
    .quick-card-text h3 {
        margin: 0 0 4px 0;
        font-size: 0.9rem;
        font-weight: 700;
        color: #0f172a;
    }
    .quick-card-text p {
        margin: 0;
        font-size: 0.8rem;
        color: #94a3b8;
        line-height: 1.4;
    }

    .gdrive-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }
    .gdrive-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .gdrive-icon {
        width: 48px; height: 48px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .gdrive-info-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 2px;
    }
    .gdrive-info-desc {
        font-size: 0.8rem;
        color: #94a3b8;
    }
</style>

<!-- Greeting -->
<div class="dash-greeting-card">
    <div class="dash-greeting-title">Selamat datang kembali 👋</div>
    <div class="dash-greeting-sub">Kelola pangkalan data universitas dengan efisien. Pantau akreditasi, data SDM, dan validasi data di satu tempat.</div>
</div>

<!-- Stats -->
<div class="dash-stats">
    <div class="stat-card">
        <div class="stat-icon primary">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 10 3 12 0v-5"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total Prodi</div>
            <div class="stat-value">{{ number_format($stats['prodi']) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon success">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Data Dosen</div>
            <div class="stat-value">{{ number_format($stats['dosen']) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon warning">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Data Tendik</div>
            <div class="stat-value">{{ number_format($stats['tendik']) }}</div>
        </div>
    </div>

</div>

<!-- Charts -->
<div class="dash-charts">
    <div class="chart-card">
        <div class="chart-title">Dosen Berdasarkan Jabatan</div>
        <div style="position: relative; height: 200px;">
            <canvas id="dosenChart"></canvas>
        </div>
    </div>
    <div class="chart-card">
        <div class="chart-title">Tendik Berdasarkan Status</div>
        <div style="position: relative; height: 200px;">
            <canvas id="tendikChart"></canvas>
        </div>
    </div>
    <div class="chart-card">
        <div class="chart-title">Sebaran Akreditasi Prodi</div>
        <div style="position: relative; height: 200px;">
            <canvas id="akredChart"></canvas>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="section-title">Aksi Cepat</div>
<div class="quick-links">
    <a href="{{ route('admin.akreditasi-prodi.index') }}" class="quick-card">
        <div class="quick-card-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <div class="quick-card-text">
            <h3>Kelola Prodi</h3>
            <p>Tambah atau update status akreditasi Program Studi UGK.</p>
        </div>
    </a>

    <a href="{{ route('admin.dosen.index') }}" class="quick-card">
        <div class="quick-card-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
        </div>
        <div class="quick-card-text">
            <h3>Tambah Dosen</h3>
            <p>Masukkan data dosen baru ke dalam pangkalan data.</p>
        </div>
    </a>

    <a href="{{ route('admin.buku-akademik.index') }}" class="quick-card">
        <div class="quick-card-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
        </div>
        <div class="quick-card-text">
            <h3>Upload Buku Akademik</h3>
            <p>Upload dokumen panduan akademik untuk semester baru.</p>
        </div>
    </a>
</div>

<!-- Google Drive -->
<div style="margin-top: 24px;">
    <div class="section-title">Integrasi Google Drive</div>
    <div class="gdrive-card">
        <div class="gdrive-left">
            <div class="gdrive-icon" style="{{ $gdriveConnected ? 'background: rgba(16,185,129,.08); color: #10b981;' : 'background: rgba(245,158,11,.08); color: #f59e0b;' }}">
                @if($gdriveConnected)
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                @else
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                @endif
            </div>
            <div>
                <div class="gdrive-info-title">
                    {{ $gdriveConnected ? '✅ Google Drive Terhubung' : '⚠️ Google Drive Belum Terhubung' }}
                </div>
                <div class="gdrive-info-desc">
                    {{ $gdriveConnected ? 'Anda dapat mengarsipkan berkas pengajuan ke Google Drive.' : 'Hubungkan untuk mengarsipkan berkas dan hemat storage.' }}
                </div>
            </div>
        </div>
        <div>
            @if($gdriveConnected)
                <form action="{{ route('admin.google.disconnect') }}" method="POST" onsubmit="return confirm('Yakin ingin memutuskan koneksi?')">
                    @csrf
                    <button type="submit" style="background: rgba(239,68,68,.06); color: #ef4444; border: 1px solid rgba(239,68,68,.12); padding: 8px 18px; border-radius: 100px; font-family: inherit; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all .2s; white-space: nowrap;">
                        Putuskan
                    </button>
                </form>
            @else
                <a href="{{ route('admin.google.auth') }}" style="display: inline-flex; align-items: center; gap: 6px; background: #6366f1; color: white; padding: 8px 18px; border-radius: 100px; text-decoration: none; font-size: 0.8rem; font-weight: 600; transition: all .2s; white-space: nowrap;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Hubungkan
                </a>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
    const chartData = @json($chartData);
    const chartColors = ['#6366f1', '#10b981', '#f59e0b', '#a855f7', '#f43f5e', '#06b6d4'];
    const chartOpts = {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '68%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: { usePointStyle: true, boxWidth: 6, padding: 14, font: { size: 11, family: 'Inter', weight: '500' } }
            }
        }
    };

    new Chart(document.getElementById('dosenChart'), {
        type: 'doughnut',
        data: {
            labels: chartData.dosen.map(d => d.jabatan || 'Belum Diisi'),
            datasets: [{ data: chartData.dosen.map(d => d.total), backgroundColor: chartColors, borderWidth: 0, spacing: 2 }]
        },
        options: chartOpts
    });

    new Chart(document.getElementById('tendikChart'), {
        type: 'doughnut',
        data: {
            labels: chartData.tendik.map(t => t.status_kepegawaian || 'Belum Diisi'),
            datasets: [{ data: chartData.tendik.map(t => t.total), backgroundColor: chartColors, borderWidth: 0, spacing: 2 }]
        },
        options: chartOpts
    });

    new Chart(document.getElementById('akredChart'), {
        type: 'doughnut',
        data: {
            labels: chartData.akred.map(a => a.peringkat || 'Belum Diisi'),
            datasets: [{ data: chartData.akred.map(a => a.total), backgroundColor: chartColors, borderWidth: 0, spacing: 2 }]
        },
        options: chartOpts
    });
</script>

@endsection
