/* ===== PDPT UGK — Home Dashboard JavaScript ===== */

// ══════════════════════════════════════════════
// DUMMY DATA (akan diganti data dari database)
// ══════════════════════════════════════════════

const DB_DATA = window.dbChartData || {};

const defaultColors = ['#2563eb', '#059669', '#f59e0b', '#e11d48', '#8b5cf6', '#d97706', '#0ea5e9'];
const defaultHovers = ['#1d4ed8', '#047857', '#d97706', '#be123c', '#7c3aed', '#b45309', '#0284c7'];

function mapToChart(dataArr, labelKey, valueKey) {
    if (!dataArr || !Array.isArray(dataArr)) {
        // Handle if dataArr is an object (like jenjang which used countBy)
        if (dataArr && typeof dataArr === 'object') {
            const keys = Object.keys(dataArr);
            return {
                labels: keys,
                data: keys.map(k => dataArr[k]),
                colors: defaultColors.slice(0, keys.length),
                hoverColors: defaultHovers.slice(0, keys.length)
            };
        }
        return { labels: [], data: [], colors: [], hoverColors: [] };
    }
    return {
        labels: dataArr.map(d => d[labelKey]),
        data: dataArr.map(d => d[valueKey]),
        colors: defaultColors.slice(0, dataArr.length),
        hoverColors: defaultHovers.slice(0, dataArr.length)
    };
}

const CHART_DATA = {
    akreditasi: mapToChart(DB_DATA.akred, 'peringkat', 'total'),
    prodi: mapToChart(DB_DATA.jenjang, null, null), // jenjang is a key-value object
    dosen: mapToChart(DB_DATA.dosen, 'jabatan_akademik', 'total'),
    tendik: mapToChart(DB_DATA.tendik, 'status_pegawai', 'total')
};


// ══════════════════════════════════════════════
// CHART INITIALIZATION
// ══════════════════════════════════════════════

// Global Chart.js defaults
Chart.defaults.font.family = "'Inter', system-ui, -apple-system, sans-serif";
Chart.defaults.font.size = 12;
Chart.defaults.plugins.legend.position = 'bottom';
Chart.defaults.plugins.legend.labels.padding = 16;
Chart.defaults.plugins.legend.labels.usePointStyle = true;
Chart.defaults.plugins.legend.labels.pointStyleWidth = 12;
Chart.defaults.animation.duration = 1200;
Chart.defaults.animation.easing = 'easeOutQuart';

function createDoughnutChart(canvasId, data) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return null;

    return new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.data,
                backgroundColor: data.colors,
                hoverBackgroundColor: data.hoverColors,
                borderWidth: 3,
                borderColor: '#ffffff',
                hoverBorderColor: '#ffffff',
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '45%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 14,
                        font: { size: 11.5, weight: '500' },
                        color: '#334155',
                        generateLabels: function(chart) {
                            const dataset = chart.data.datasets[0];
                            return chart.data.labels.map((label, i) => ({
                                text: `${label}: ${dataset.data[i]}`,
                                fillStyle: dataset.backgroundColor[i],
                                strokeStyle: dataset.backgroundColor[i],
                                lineWidth: 0,
                                pointStyle: 'circle',
                                hidden: false,
                                index: i
                            }));
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15,23,42,.9)',
                    titleFont: { size: 12, weight: '600' },
                    bodyFont: { size: 11.5 },
                    padding: 12,
                    cornerRadius: 10,
                    displayColors: true,
                    boxPadding: 6,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const pct = ((context.parsed / total) * 100).toFixed(1);
                            return ` ${context.label}: ${context.parsed} (${pct}%)`;
                        }
                    }
                }
            }
        }
    });
}

function createBarChart(canvasId, data) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return null;

    return new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Jumlah',
                data: data.data,
                backgroundColor: data.colors,
                hoverBackgroundColor: data.hoverColors,
                borderRadius: 8,
                borderSkipped: false,
                barPercentage: 0.65,
                categoryPercentage: 0.8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15,23,42,.9)',
                    titleFont: { size: 12, weight: '600' },
                    bodyFont: { size: 11.5 },
                    padding: 12,
                    cornerRadius: 10,
                    displayColors: true,
                    boxPadding: 6
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { size: 11, weight: '500' },
                        color: '#64748b'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(226,232,240,.6)',
                        drawBorder: false
                    },
                    ticks: {
                        font: { size: 11 },
                        color: '#94a3b8',
                        padding: 8
                    }
                }
            }
        }
    });
}

// Initialize charts
document.addEventListener('DOMContentLoaded', () => {
    createDoughnutChart('chartAkreditasi', CHART_DATA.akreditasi);
    createDoughnutChart('chartProdi', CHART_DATA.prodi);
    createBarChart('chartDosen', CHART_DATA.dosen);
    createBarChart('chartTendik', CHART_DATA.tendik);
});


// ══════════════════════════════════════════════
// NAVBAR INTERACTIONS
// ══════════════════════════════════════════════

(function initNavbar() {
    // Dropdown toggles
    const dropdownItems = document.querySelectorAll('.nav-item:not(a)');

    dropdownItems.forEach(item => {
        if (!item.querySelector('.nav-dropdown')) return;

        item.addEventListener('click', (e) => {
            // Don't toggle if clicking inside dropdown
            if (e.target.closest('.nav-dropdown')) return;

            e.stopPropagation();
            const isOpen = item.classList.contains('open');

            // Close all others
            dropdownItems.forEach(d => d.classList.remove('open'));

            if (!isOpen) {
                item.classList.add('open');
            }
        });
    });

    // Close dropdowns on outside click
    document.addEventListener('click', () => {
        dropdownItems.forEach(d => d.classList.remove('open'));
    });

    // Mobile toggle
    const navToggle = document.getElementById('navToggle');
    const navItems = document.getElementById('navItems');

    if (navToggle && navItems) {
        navToggle.addEventListener('click', () => {
            navItems.classList.toggle('mobile-open');
        });
    }
})();


// ══════════════════════════════════════════════
// STAT COUNTER ANIMATION
// ══════════════════════════════════════════════

(function animateCounters() {
    const stats = window.dbStats || { akreditasi_institusi: 0, akreditasi_prodi: 0, dosen: 0, tendik: 0 };
    const counters = [
        { el: 'statAkreditasi', target: stats.akreditasi_institusi },
        { el: 'statProdi', target: stats.akreditasi_prodi },
        { el: 'statDosen', target: stats.dosen },
        { el: 'statTendik', target: stats.tendik }
    ];

    function easeOut(t) {
        return 1 - Math.pow(1 - t, 3);
    }

    counters.forEach(({ el, target }) => {
        const elem = document.getElementById(el);
        if (!elem) return;

        const duration = 1500;
        const startTime = performance.now();

        function update(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOut(progress);
            const current = Math.round(easedProgress * target);
            elem.textContent = current.toLocaleString('id-ID');

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }

        requestAnimationFrame(update);
    });
})();
