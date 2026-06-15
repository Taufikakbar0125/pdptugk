/* ===== PDPT UGK — Rekapitulasi Pages JavaScript ===== */

// ══════════════════════════════════════════════
// DUMMY DATA — Rekapitulasi Dosen per Fakultas
// ══════════════════════════════════════════════

const REKAP_DOSEN = window.DB_REKAP_DOSEN || [
    { unit:'Fakultas Ilmu Pendidikan', pns:159, cpns:0, kontrak:0, tetapNonPns:17 },
    { unit:'Fakultas Matematika dan Ilmu Pengetahuan Alam', pns:153, cpns:0, kontrak:0, tetapNonPns:13 },
    { unit:'Fakultas Teknik', pns:180, cpns:2, kontrak:0, tetapNonPns:22 },
    { unit:'Fakultas Bahasa, Seni, dan Budaya', pns:142, cpns:1, kontrak:0, tetapNonPns:9 },
    { unit:'Fakultas Ilmu Keolahragaan dan Kesehatan', pns:68, cpns:0, kontrak:0, tetapNonPns:8 },
];

// ══════════════════════════════════════════════
// DUMMY DATA — Rekapitulasi Tendik per Unit Kerja
// ══════════════════════════════════════════════

const REKAP_TENDIK = window.DB_REKAP_TENDIK || [
    { unit:'Fakultas Ilmu Pendidikan', pns:14, cpns:0, kontrak:28 },
    { unit:'Fakultas Matematika dan Ilmu Pengetahuan Alam', pns:17, cpns:0, kontrak:10 },
    { unit:'Fakultas Teknik', pns:22, cpns:1, kontrak:15 },
    { unit:'Fakultas Bahasa, Seni, dan Budaya', pns:12, cpns:0, kontrak:8 },
];


// ══════════════════════════════════════════════
// CHART.JS DEFAULTS
// ══════════════════════════════════════════════

Chart.defaults.font.family = "'Inter', system-ui, -apple-system, sans-serif";
Chart.defaults.font.size = 11;
Chart.defaults.animation.duration = 1200;
Chart.defaults.animation.easing = 'easeOutQuart';


// ══════════════════════════════════════════════
// INIT: REKAPITULASI DOSEN
// ══════════════════════════════════════════════

function initRekapDosen() {
    const chartCanvas = document.getElementById('chartRekapDosen');
    if (!chartCanvas) return;

    const totals = REKAP_DOSEN.reduce((acc, r) => {
        acc.pns += r.pns; acc.cpns += r.cpns; acc.kontrak += r.kontrak; acc.tetapNonPns += r.tetapNonPns;
        return acc;
    }, { pns:0, cpns:0, kontrak:0, tetapNonPns:0 });
    totals.total = totals.pns + totals.cpns + totals.kontrak + totals.tetapNonPns;

    // Animate stat numbers
    animateNum('rdStatPns', totals.pns);
    animateNum('rdStatCpns', totals.cpns);
    animateNum('rdStatKontrak', totals.kontrak);
    animateNum('rdStatTetap', totals.tetapNonPns);
    animateNum('rdStatTotal', totals.total);

    // Short labels for chart
    const shortLabels = REKAP_DOSEN.map(r => {
        const s = r.unit.replace('Fakultas ','F. ').replace('Sekolah ','S. ').replace(' dan ',' & ').replace(' Ilmu ',' ');
        return s.length > 20 ? s.substring(0,18) + '…' : s;
    });

    new Chart(chartCanvas, {
        type: 'bar',
        data: {
            labels: shortLabels,
            datasets: [
                { label:'PNS', data:REKAP_DOSEN.map(r=>r.pns), backgroundColor:'#2563eb', borderRadius:4, barPercentage:.7 },
                { label:'CPNS', data:REKAP_DOSEN.map(r=>r.cpns), backgroundColor:'#f59e0b', borderRadius:4, barPercentage:.7 },
                { label:'Kontrak', data:REKAP_DOSEN.map(r=>r.kontrak), backgroundColor:'#ef4444', borderRadius:4, barPercentage:.7 },
                { label:'Tetap Non PNS', data:REKAP_DOSEN.map(r=>r.tetapNonPns), backgroundColor:'#10b981', borderRadius:4, barPercentage:.7 },
            ]
        },
        options: barChartOpts('Jumlah Dosen Berdasarkan Status per Fakultas')
    });

    // Doughnut chart
    const doughnutCanvas = document.getElementById('chartRekapDosenPie');
    if (doughnutCanvas) {
        new Chart(doughnutCanvas, {
            type: 'doughnut',
            data: {
                labels: ['PNS', 'CPNS', 'Kontrak', 'Tetap Non PNS'],
                datasets: [{
                    data: [totals.pns, totals.cpns, totals.kontrak, totals.tetapNonPns],
                    backgroundColor: ['#2563eb', '#f59e0b', '#ef4444', '#10b981'],
                    hoverBackgroundColor: ['#1d4ed8', '#d97706', '#dc2626', '#059669'],
                    borderWidth: 3, borderColor: '#fff', hoverOffset: 8
                }]
            },
            options: doughnutOpts()
        });
    }

    // Table
    renderRekapTable('rekapDosenTableBody', REKAP_DOSEN, 'dosen');
}


// ══════════════════════════════════════════════
// INIT: REKAPITULASI TENDIK
// ══════════════════════════════════════════════

function initRekapTendik() {
    const chartCanvas = document.getElementById('chartRekapTendik');
    if (!chartCanvas) return;

    const totals = REKAP_TENDIK.reduce((acc, r) => {
        acc.pns += r.pns; acc.cpns += r.cpns; acc.kontrak += r.kontrak;
        return acc;
    }, { pns:0, cpns:0, kontrak:0 });
    totals.total = totals.pns + totals.cpns + totals.kontrak;

    animateNum('rtStatPns', totals.pns);
    animateNum('rtStatCpns', totals.cpns);
    animateNum('rtStatKontrak', totals.kontrak);
    animateNum('rtStatTotal', totals.total);

    const shortLabels = REKAP_TENDIK.map(r => {
        const s = r.unit.replace('Fakultas ','F. ').replace('Direktorat ','Dir. ').replace('Kantor ','K. ').replace(' dan ',' & ');
        return s.length > 18 ? s.substring(0,16) + '…' : s;
    });

    new Chart(chartCanvas, {
        type: 'bar',
        data: {
            labels: shortLabels,
            datasets: [
                { label:'PNS', data:REKAP_TENDIK.map(r=>r.pns), backgroundColor:'#2563eb', borderRadius:4, barPercentage:.7 },
                { label:'CPNS', data:REKAP_TENDIK.map(r=>r.cpns), backgroundColor:'#f59e0b', borderRadius:4, barPercentage:.7 },
                { label:'Kontrak', data:REKAP_TENDIK.map(r=>r.kontrak), backgroundColor:'#ef4444', borderRadius:4, barPercentage:.7 },
            ]
        },
        options: barChartOpts('Jumlah Tenaga Pendidik Berdasarkan Status per Unit Kerja')
    });

    // Doughnut chart
    const doughnutCanvas = document.getElementById('chartRekapTendikPie');
    if (doughnutCanvas) {
        new Chart(doughnutCanvas, {
            type: 'doughnut',
            data: {
                labels: ['PNS', 'CPNS', 'Kontrak'],
                datasets: [{
                    data: [totals.pns, totals.cpns, totals.kontrak],
                    backgroundColor: ['#2563eb', '#f59e0b', '#ef4444'],
                    hoverBackgroundColor: ['#1d4ed8', '#d97706', '#dc2626'],
                    borderWidth: 3, borderColor: '#fff', hoverOffset: 8
                }]
            },
            options: doughnutOpts()
        });
    }

    renderRekapTable('rekapTendikTableBody', REKAP_TENDIK, 'tendik');
}


// ══════════════════════════════════════════════
// SHARED: Chart option builders
// ══════════════════════════════════════════════

function barChartOpts(title) {
    return {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position:'bottom', labels:{ padding:14, font:{ size:11, weight:'500' }, usePointStyle:true, pointStyleWidth:10 } },
            tooltip: {
                backgroundColor:'rgba(15,23,42,.92)', titleFont:{ size:12, weight:'600' }, bodyFont:{ size:11 },
                padding:12, cornerRadius:10, displayColors:true, boxPadding:6
            },
            title: { display:true, text:title, font:{ size:13, weight:'700' }, color:'#0f172a', padding:{ bottom:20 } }
        },
        scales: {
            x: {
                grid:{ display:false },
                ticks:{ font:{ size:9.5, weight:'500' }, color:'#64748b', maxRotation:45, minRotation:30 }
            },
            y: {
                beginAtZero:true,
                grid:{ color:'rgba(226,232,240,.5)', drawBorder:false },
                ticks:{ font:{ size:10 }, color:'#94a3b8', padding:8, stepSize: 50 }
            }
        }
    };
}

function doughnutOpts() {
    return {
        responsive: true,
        maintainAspectRatio: true,
        cutout: '50%',
        plugins: {
            legend: {
                position:'bottom',
                labels: {
                    padding:14, font:{ size:11.5, weight:'500' }, color:'#334155', usePointStyle:true, pointStyleWidth:12,
                    generateLabels: function(chart) {
                        const ds = chart.data.datasets[0];
                        return chart.data.labels.map((l, i) => ({
                            text:`${l}: ${ds.data[i].toLocaleString('id-ID')}`,
                            fillStyle:ds.backgroundColor[i], strokeStyle:ds.backgroundColor[i],
                            lineWidth:0, pointStyle:'circle', hidden:false, index:i
                        }));
                    }
                }
            },
            tooltip: {
                backgroundColor:'rgba(15,23,42,.92)', titleFont:{ size:12, weight:'600' }, bodyFont:{ size:11 },
                padding:12, cornerRadius:10, boxPadding:6,
                callbacks: {
                    label: ctx => {
                        const t = ctx.dataset.data.reduce((a,b) => a+b, 0);
                        return ` ${ctx.label}: ${ctx.parsed.toLocaleString('id-ID')} (${((ctx.parsed/t)*100).toFixed(1)}%)`;
                    }
                }
            }
        }
    };
}


// ══════════════════════════════════════════════
// SHARED: Render rekap table
// ══════════════════════════════════════════════

function renderRekapTable(tbodyId, data, type) {
    const tbody = document.getElementById(tbodyId);
    if (!tbody) return;

    tbody.innerHTML = data.map((r, i) => {
        const total = type === 'dosen'
            ? r.pns + r.cpns + r.kontrak + r.tetapNonPns
            : r.pns + r.cpns + r.kontrak;

        let cells = `
            <td class="row-num">${i+1}</td>
            <td class="prodi-name" style="font-size:.82rem">${r.unit}</td>
            <td><span class="num-badge blue">${r.pns}</span></td>
            <td><span class="num-badge amber">${r.cpns}</span></td>
            <td><span class="num-badge red">${r.kontrak}</span></td>`;

        if (type === 'dosen') {
            cells += `<td><span class="num-badge green">${r.tetapNonPns}</span></td>`;
        }

        cells += `<td><span class="num-badge total">${total}</span></td>`;
        return `<tr>${cells}</tr>`;
    }).join('');

    // Add footer totals row
    const totals = data.reduce((acc, r) => {
        acc.pns += r.pns; acc.cpns += r.cpns; acc.kontrak += r.kontrak;
        if (type === 'dosen') acc.tetapNonPns += (r.tetapNonPns || 0);
        return acc;
    }, { pns:0, cpns:0, kontrak:0, tetapNonPns:0 });
    const grandTotal = type === 'dosen'
        ? totals.pns + totals.cpns + totals.kontrak + totals.tetapNonPns
        : totals.pns + totals.cpns + totals.kontrak;

    let footCells = `
        <td></td>
        <td class="prodi-name" style="font-weight:800">TOTAL</td>
        <td><span class="num-badge blue">${totals.pns}</span></td>
        <td><span class="num-badge amber">${totals.cpns}</span></td>
        <td><span class="num-badge red">${totals.kontrak}</span></td>`;
    if (type === 'dosen') footCells += `<td><span class="num-badge green">${totals.tetapNonPns}</span></td>`;
    footCells += `<td><span class="num-badge total">${grandTotal}</span></td>`;

    tbody.innerHTML += `<tr style="background:rgba(241,245,249,.6);font-weight:700">${footCells}</tr>`;
}


// ══════════════════════════════════════════════
// SHARED: Animate numbers
// ══════════════════════════════════════════════

function animateNum(id, target) {
    const el = document.getElementById(id);
    if (!el) return;
    const dur = 1400, start = performance.now();
    function tick(now) {
        const p = Math.min((now - start) / dur, 1);
        const ep = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.round(ep * target).toLocaleString('id-ID');
        if (p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
}


// ══════════════════════════════════════════════
// NAVBAR (shared)
// ══════════════════════════════════════════════

(function initNavbar() {
    const dropdownItems = document.querySelectorAll('.nav-item:not(a)');
    dropdownItems.forEach(item => {
        if (!item.querySelector('.nav-dropdown')) return;
        item.addEventListener('click', (e) => {
            if (e.target.closest('.nav-dropdown-item')) return;
            e.stopPropagation();
            const isOpen = item.classList.contains('open');
            dropdownItems.forEach(d => d.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        });
    });
    document.addEventListener('click', () => { dropdownItems.forEach(d => d.classList.remove('open')); });
    const navToggle = document.getElementById('navToggle');
    const navItems = document.getElementById('navItems');
    if (navToggle && navItems) navToggle.addEventListener('click', () => navItems.classList.toggle('mobile-open'));
})();


// ══════════════════════════════════════════════
// EXPORT
// ══════════════════════════════════════════════

window.exportRekapTable = function() { alert('Export Table — Fitur ini akan segera tersedia.'); };


// ══════════════════════════════════════════════
// INIT
// ══════════════════════════════════════════════

document.addEventListener('DOMContentLoaded', () => {
    initRekapDosen();
    initRekapTendik();
});
