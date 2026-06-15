@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .dash-header {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        border-radius: 16px;
        padding: 32px 40px;
        color: #fff;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.3);
    }
    .dash-header::before {
        content: '';
        position: absolute;
        top: -50%; left: -10%;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .dash-header::after {
        content: '';
        position: absolute;
        bottom: -20%; right: -5%;
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .dash-greeting {
        position: relative;
        z-index: 1;
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }
    .dash-subtitle {
        position: relative;
        z-index: 1;
        font-size: 0.95rem;
        color: rgba(255,255,255,0.8);
        max-width: 600px;
        line-height: 1.6;
    }

    .dash-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -2px rgba(0, 0, 0, 0.02);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: default;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.08);
        border-color: rgba(59, 130, 246, 0.3);
    }
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-icon.primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .stat-icon.success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .stat-icon.warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .stat-icon.purple  { background: rgba(139, 92, 246, 0.1); color: #8b5cf6; }
    .stat-icon.rose    { background: rgba(225, 29, 72, 0.1); color: #e11d48; }

    .stat-info { flex: 1; }
    .stat-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }
    .stat-value {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
    }

    .dash-quick-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }
    .quick-link-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        display: flex;
        align-items: flex-start;
        gap: 16px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .quick-link-card:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    .quick-link-icon {
        width: 44px; height: 44px;
        background: #f1f5f9;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #475569;
    }
    .quick-link-text h3 {
        margin: 0 0 4px 0;
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
    }
    .quick-link-text p {
        margin: 0;
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.5;
    }
</style>

<style>
    .dash-charts {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    .chart-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }
    .chart-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
    }
</style>

<div class="dash-stats">
    <div class="stat-card">
        <div class="stat-icon primary">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 10 3 12 0v-5"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total Prodi</div>
            <div class="stat-value">{{ number_format($stats['prodi']) }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon success">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Data Dosen</div>
            <div class="stat-value">{{ number_format($stats['dosen']) }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon warning">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Data Tendik</div>
            <div class="stat-value">{{ number_format($stats['tendik']) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Akred. Internasional</div>
            <div class="stat-value">{{ number_format($stats['internasional']) }}</div>
        </div>
    </div>
</div>

<div class="dash-charts">
    <div class="chart-card">
        <div class="chart-title">Data Dosen Berdasarkan Jabatan</div>
        <div style="position: relative; height: 230px;">
            <canvas id="dosenChart"></canvas>
        </div>
    </div>
    <div class="chart-card">
        <div class="chart-title">Data Tendik Berdasarkan Status</div>
        <div style="position: relative; height: 230px;">
            <canvas id="tendikChart"></canvas>
        </div>
    </div>
    <div class="chart-card">
        <div class="chart-title">Sebaran Akreditasi Prodi</div>
        <div style="position: relative; height: 230px;">
            <canvas id="akredChart"></canvas>
        </div>
    </div>
</div>

<h2 style="font-size: 1.1rem; font-weight: 700; color: #1e293b; margin-bottom: 16px;">Aksi Cepat</h2>
<div class="dash-quick-links">
    <a href="{{ route('admin.akreditasi-prodi.index') }}" class="quick-link-card">
        <div class="quick-link-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <div class="quick-link-text">
            <h3>Kelola Prodi</h3>
            <p>Tambah atau update status akreditasi Program Studi UGK.</p>
        </div>
    </a>
    
    <a href="{{ route('admin.dosen.index') }}" class="quick-link-card">
        <div class="quick-link-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
        </div>
        <div class="quick-link-text">
            <h3>Tambah Dosen</h3>
            <p>Masukkan data dosen baru ke dalam pangkalan data.</p>
        </div>
    </a>

    <a href="{{ route('admin.buku-akademik.index') }}" class="quick-link-card">
        <div class="quick-link-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
        </div>
        <div class="quick-link-text">
            <h3>Upload Buku Akademik</h3>
            <p>Upload dokumen panduan akademik untuk semester baru.</p>
        </div>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
    const chartData = @json($chartData);
    
    new Chart(document.getElementById('dosenChart'), {
        type: 'doughnut',
        data: {
            labels: chartData.dosen.map(d => d.jabatan || 'Belum Diisi'),
            datasets: [{
                data: chartData.dosen.map(d => d.total),
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#e11d48']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '65%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8 } } } }
    });

    new Chart(document.getElementById('tendikChart'), {
        type: 'doughnut',
        data: {
            labels: chartData.tendik.map(t => t.status_kepegawaian || 'Belum Diisi'),
            datasets: [{
                data: chartData.tendik.map(t => t.total),
                backgroundColor: ['#f59e0b', '#3b82f6', '#e11d48']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '65%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8 } } } }
    });

    new Chart(document.getElementById('akredChart'), {
        type: 'doughnut',
        data: {
            labels: chartData.akred.map(a => a.peringkat || 'Belum Diisi'),
            datasets: [{
                data: chartData.akred.map(a => a.total),
                backgroundColor: ['#8b5cf6', '#10b981', '#3b82f6', '#f59e0b', '#e11d48']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '65%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8 } } } }
    });
</script>

@endsection
