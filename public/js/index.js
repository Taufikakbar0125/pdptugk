const THEMES = {
    blue: { bands: ['#1a3a6e', '#1d4480', '#2255a0', '#1a3a6e', '#152f5c', '#1d4480', '#2255a0'], deep: '#0a1628', cloud: 'rgba(180,210,255,0.13)', glow: '#4a90d9' },
    green: { bands: ['#2e6e4a', '#3a8a5c', '#276040', '#3a8a5c', '#215535', '#3a8a5c', '#276040'], deep: '#0e2018', cloud: 'rgba(160,240,190,0.11)', glow: '#4ad980' },
    brown: { bands: ['#5c3a1e', '#7a4e28', '#a06030', '#7a4e28', '#5c3a1e', '#7a4e28', '#a06030'], deep: '#1e1008', cloud: 'rgba(255,210,140,0.12)', glow: '#e0903a' },
    purple: { bands: ['#6e3a6e', '#8a4a8a', '#7a3d7a', '#8a4a8a', '#5c2e5c', '#8a4a8a', '#7a3d7a'], deep: '#1a0820', cloud: 'rgba(220,160,255,0.12)', glow: '#c04ad9' },
    cyan: { bands: ['#1e3a6e', '#2a4e8a', '#1a305c', '#2a4e8a', '#3a6aaa', '#2a4e8a', '#1a305c'], deep: '#08101e', cloud: 'rgba(140,200,255,0.14)', glow: '#40c0ff' },
    red: { bands: ['#6e1a1a', '#8a2a2a', '#a03030', '#8a2a2a', '#5c1515', '#8a2a2a', '#a03030'], deep: '#280a0a', cloud: 'rgba(255,180,180,0.15)', glow: '#d94a4a' },
    gold: { bands: ['#8c6e2a', '#a88532', '#c49a3a', '#a88532', '#705822', '#a88532', '#c49a3a'], deep: '#2a220a', cloud: 'rgba(255,220,150,0.12)', glow: '#e5b645' }
};

const MENUS = (window.DB_MENUS && window.DB_MENUS.length > 0) ? window.DB_MENUS.map((m, i) => {
    const t = THEMES[m.theme] || THEMES.blue;
    return {
        name: m.name, desc: m.desc, icon: m.icon, num: '0' + (i + 1), url: m.url,
        bands: t.bands, deep: t.deep, cloud: t.cloud, glow: t.glow
    };
}) : [ { name: 'Portal Kosong', desc: 'Belum ada menu yang ditambahkan di admin.', icon: '🌍', num: '01', url: '#', ...THEMES.blue } ];

(function stars() {
    const c = document.getElementById('space');
    const ctx = c.getContext('2d');
    let W, H;
    let pts = [];
    const N = 220;

    function resize() {
        W = c.width = window.innerWidth;
        H = c.height = window.innerHeight;
    }

    function mk() {
        return {
            x: Math.random() * W,
            y: Math.random() * H,
            r: Math.random() * 1.4 + 0.2,
            a: Math.random() * 0.7 + 0.1,
            tw: Math.random() * 4 + 2,
            tp: Math.random() * Math.PI * 2
        };
    }

    function init() {
        resize();
        pts = Array.from({ length: N }, mk);
    }

    function draw(now) {
        const t = now * 0.001;
        ctx.clearRect(0, 0, W, H);
        const rg = ctx.createRadialGradient(W * 0.5, H * 0.4, 0, W * 0.5, H * 0.4, Math.max(W, H) * 0.6);
        rg.addColorStop(0, 'rgba(20,40,90,.18)');
        rg.addColorStop(1, 'rgba(2,11,24,0)');
        ctx.fillStyle = rg;
        ctx.fillRect(0, 0, W, H);

        pts.forEach(p => {
            const a = p.a * (0.6 + 0.4 * Math.sin(t / p.tw + p.tp));
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(200,220,255,${a})`;
            ctx.fill();
        });

        if (Math.floor(t * 10) % 40 === 0 && Math.sin(t * 7) > 0.97) {
            const sx = Math.random() * W;
            const sy = Math.random() * H * 0.5;
            const len = 80 + Math.random() * 120;
            const g = ctx.createLinearGradient(sx, sy, sx + len, sy + len * 0.3);
            g.addColorStop(0, 'rgba(255,255,255,0)');
            g.addColorStop(0.5, 'rgba(255,255,255,.7)');
            g.addColorStop(1, 'rgba(255,255,255,0)');
            ctx.beginPath();
            ctx.moveTo(sx, sy);
            ctx.lineTo(sx + len, sy + len * 0.3);
            ctx.strokeStyle = g;
            ctx.lineWidth = 1.5;
            ctx.stroke();
        }
        requestAnimationFrame(draw);
    }

    window.addEventListener('resize', init);
    init();
    requestAnimationFrame(draw);
})();

function createPlanetRenderer(cfg, size) {
    const TEX_W = size * 3;
    const TEX_H = size * 1.5;
    const texOff = document.createElement('canvas');
    texOff.width = TEX_W;
    texOff.height = TEX_H;
    const tx = texOff.getContext('2d');
    tx.fillStyle = cfg.deep;
    tx.fillRect(0, 0, TEX_W, TEX_H);
    const bLen = cfg.bands.length;

    cfg.bands.forEach((col, i) => {
        const y0 = (i / bLen) * TEX_H;
        const h = TEX_H / bLen;
        const g = tx.createLinearGradient(0, y0, 0, y0 + h);
        g.addColorStop(0, col);
        g.addColorStop(1, cfg.bands[(i + 1) % bLen]);
        tx.fillStyle = g;
        tx.fillRect(0, y0, TEX_W, h + 1);
    });

    for (let p = 0; p < 18; p++) {
        const px = Math.random() * TEX_W;
        const py = TEX_H * 0.15 + Math.random() * TEX_H * 0.7;
        const rw = TEX_W * 0.04 + Math.random() * TEX_W * 0.09;
        const rh = rw * 0.4 + Math.random() * rw * 0.4;
        const g2 = tx.createRadialGradient(px, py, 0, px, py, rw);
        g2.addColorStop(0, 'rgba(255,255,255,.08)');
        g2.addColorStop(1, 'rgba(0,0,0,0)');
        tx.fillStyle = g2;
        tx.beginPath();
        tx.ellipse(px, py, rw, rh, Math.random() * Math.PI, 0, Math.PI * 2);
        tx.fill();
    }

    for (let c = 0; c < 12; c++) {
        const cx = Math.random() * TEX_W;
        const cy = TEX_H * 0.1 + Math.random() * TEX_H * 0.8;
        const cw = TEX_W * 0.06 + Math.random() * TEX_W * 0.12;
        const gc = tx.createRadialGradient(cx, cy, 0, cx, cy, cw);
        gc.addColorStop(0, cfg.cloud.replace('0.', '0.2'));
        gc.addColorStop(1, cfg.cloud.replace(/[\d.]+\)$/, '0)'));
        tx.fillStyle = gc;
        tx.beginPath();
        tx.ellipse(cx, cy, cw, cw * 0.25, 0, 0, Math.PI * 2);
        tx.fill();
    }

    const sphereOff = document.createElement('canvas');
    sphereOff.width = size;
    sphereOff.height = size;
    const sc = sphereOff.getContext('2d');
    const R = size / 2;
    const shadeOff = document.createElement('canvas');
    shadeOff.width = size;
    shadeOff.height = size;
    const shCtx = shadeOff.getContext('2d');
    const pg1 = shCtx.createRadialGradient(R, R * 0.55, 0, R, R * 0.55, R);
    pg1.addColorStop(0, 'rgba(0,0,0,0)');
    pg1.addColorStop(0.75, 'rgba(0,0,0,0)');
    pg1.addColorStop(1, 'rgba(0,0,0,.55)');
    shCtx.beginPath();
    shCtx.arc(R, R, R, 0, Math.PI * 2);
    shCtx.fillStyle = pg1;
    shCtx.fill();

    let angle = Math.random() * Math.PI * 2;
    const BASE_SPEED = 0.004 + Math.random() * 0.003;
    let currentSpeed = BASE_SPEED;

    function setSpeed(s) {
        currentSpeed = s;
    }

    function draw() {
        sc.clearRect(0, 0, size, size);
        sc.save();
        sc.beginPath();
        sc.arc(R, R, R, 0, Math.PI * 2);
        sc.clip();

        const imgData = sc.createImageData(size, size);
        const td = tx.getImageData(0, 0, TEX_W, TEX_H);

        for (let py = 0; py < size; py++) {
            const ny = (py / size) * 2 - 1;
            if (Math.abs(ny) > 1) continue;
            const cosLat = Math.sqrt(1 - ny * ny);

            for (let px = 0; px < size; px++) {
                const nx = (px / size) * 2 - 1;
                const d2 = nx * nx + ny * ny;
                if (d2 > 1) continue;

                const nz = Math.sqrt(1 - d2);
                const lon = Math.atan2(nx / Math.max(cosLat, 0.001), nz / Math.max(cosLat, 0.001)) + angle;
                const u = ((lon / (Math.PI * 2)) % 1 + 1) % 1;
                const v = Math.asin(Math.max(-1, Math.min(1, ny))) / Math.PI + 0.5;

                const tx2 = Math.min(TEX_W - 1, Math.floor(u * TEX_W));
                const ty2 = Math.min(TEX_H - 1, Math.floor(v * TEX_H));
                const si = (ty2 * TEX_W + tx2) * 4;
                const di = (py * size + px) * 4;

                const lx = -0.55;
                const ly = -0.45;
                const lz = 0.7;
                const diff = Math.max(0, lx * nx + ly * ny + lz * nz);
                const lit = 0.22 + diff * 0.78;
                const rim = 1 - Math.pow(1 - nz, 3) * 0.6;

                imgData.data[di] = Math.min(255, td.data[si] * lit * rim);
                imgData.data[di + 1] = Math.min(255, td.data[si + 1] * lit * rim);
                imgData.data[di + 2] = Math.min(255, td.data[si + 2] * lit * rim);
                imgData.data[di + 3] = 255;
            }
        }

        sc.putImageData(imgData, 0, 0);
        sc.drawImage(shadeOff, 0, 0);

        const atmoG = sc.createRadialGradient(R, R, R * 0.72, R, R, R);
        atmoG.addColorStop(0, 'rgba(0,0,0,0)');
        atmoG.addColorStop(0.8, 'rgba(0,0,0,0)');

        const hexToRgb = h => {
            const r = parseInt(h.slice(1, 3), 16);
            const g = parseInt(h.slice(3, 5), 16);
            const b = parseInt(h.slice(5, 7), 16);
            return `${r},${g},${b}`;
        };

        atmoG.addColorStop(1, `rgba(${hexToRgb(cfg.glow)},0.35)`);
        sc.fillStyle = atmoG;
        sc.beginPath();
        sc.arc(R, R, R, 0, Math.PI * 2);
        sc.fill();

        const specG = sc.createRadialGradient(R * 0.38, R * 0.32, 0, R * 0.38, R * 0.32, R * 0.52);
        specG.addColorStop(0, 'rgba(255,255,255,.26)');
        specG.addColorStop(0.4, 'rgba(255,255,255,.07)');
        specG.addColorStop(1, 'rgba(255,255,255,0)');
        sc.fillStyle = specG;
        sc.beginPath();
        sc.arc(R, R, R, 0, Math.PI * 2);
        sc.fill();

        sc.restore();
        angle += currentSpeed;
        return sphereOff;
    }

    return { draw, setSpeed, get baseSpeed() { return BASE_SPEED; } };
}

const N = MENUS.length;
const TWO_PI = Math.PI * 2;
let orbitAngle = 0;
let orbitVelocity = 0.008;
const AUTO_SPEED = 0.008;
const MAX_SPEED = 0.35;
const FRICTION = 0.94;
let isStopped = false;
let activeIdx = 0;
const PLANET_RES = 180;

function frontIdx() {
    const THETA = TWO_PI / N;
    let best = -1;
    let bestDepth = -Infinity;
    for (let i = 0; i < N; i++) {
        const a = orbitAngle + i * THETA;
        const depth = (Math.sin(a) + 1) / 2;
        if (depth > bestDepth) {
            bestDepth = depth;
            best = i;
        }
    }
    return best;
}

function snapAngleFor(idx) {
    const THETA = TWO_PI / N;
    let target = Math.PI / 2 - idx * THETA;
    while (target - orbitAngle > Math.PI) target -= TWO_PI;
    while (orbitAngle - target > Math.PI) target += TWO_PI;
    return target;
}

const ow = document.getElementById('orbitWrap');
const pl = document.getElementById('planets');
const dotsEl = document.getElementById('dots');
const detIcon = document.getElementById('dIcon');
const detName = document.getElementById('dName');
const detDesc = document.getElementById('dDesc');
const detEl = document.getElementById('detail');
const dLink = document.getElementById('dLink');
const resumeBtn = document.getElementById('resumeBtn');
const navHint = document.getElementById('navHint');
const renderers = [];
const canvases = [];

MENUS.forEach((m, i) => {
    const slot = document.createElement('div');
    slot.className = 'planet-slot';
    const wrap = document.createElement('div');
    wrap.className = 'planet-canvas-wrap';
    wrap.style.setProperty('--glow', m.glow);

    const cnv = document.createElement('canvas');
    cnv.className = 'planet';
    cnv.width = PLANET_RES;
    cnv.height = PLANET_RES;
    cnv.setAttribute('role', 'button');
    cnv.setAttribute('tabindex', '0');
    cnv.setAttribute('aria-label', m.name);

    const atmo = document.createElement('div');
    atmo.className = 'atmo';
    atmo.style.setProperty('--glow', m.glow);
    wrap.appendChild(cnv);
    wrap.appendChild(atmo);

    const lbl = document.createElement('div');
    lbl.className = 'planet-label';
    lbl.innerHTML = `<div class="label-name">${m.name}</div>`;

    slot.appendChild(wrap);
    slot.appendChild(lbl);
    pl.appendChild(slot);
    canvases.push({ slot, wrap, cnv, atmo });

    renderers[i] = createPlanetRenderer(MENUS[i], PLANET_RES);

    function handleSelect(e) {
        if (dragTotalX > 5) {
            if (e) e.preventDefault();
            return;
        }

        if (activeIdx !== i) {
            activeIdx = i;
            isStopped = true;
            updateDetailPanel(i);
            updateStoppedUI(true);
        } else {
            if (!isStopped) {
                isStopped = true;
                updateDetailPanel(i);
                updateStoppedUI(true);
            } else {
                if (MENUS[i].url && MENUS[i].url !== '#') window.location.href = MENUS[i].url;
            }
        }
    }

    cnv.addEventListener('click', handleSelect);
    cnv.addEventListener('keydown', e => { if (e.key === 'Enter') handleSelect(); });
});

MENUS.forEach((_, i) => {
    const d = document.createElement('button');
    d.className = 'dot';
    d.setAttribute('role', 'tab');
    d.setAttribute('aria-label', 'Planet ' + (i + 1));
    d.addEventListener('click', () => {
        if (isStopped || activeIdx !== i) {
            activeIdx = i;
            isStopped = true;
            updateDetailPanel(i);
            updateStoppedUI(true);
        }
    });
    dotsEl.appendChild(d);
});

resumeBtn.addEventListener('click', () => {
    isStopped = false;
    orbitVelocity = AUTO_SPEED;
    updateStoppedUI(false);
});

dLink.addEventListener('click', () => {
    const url = MENUS[activeIdx].url;
    if (url && url !== '#') window.open(url, '_blank');
});

function updateDetailPanel(idx) {
    const m = MENUS[idx];
    detIcon.textContent = m.icon;
    detName.textContent = m.name;
    detDesc.textContent = m.desc;
}

function updateStoppedUI(stopped) {
    detEl.classList.toggle('stopped', stopped);
    ow.classList.toggle('stopped', stopped);
    navHint.classList.toggle('stopped-hint', stopped);
    navHint.textContent = stopped ? 'KLIK LAGI UNTUK BUKA \u00a0/\u00a0 \u25ba LANJUTKAN' : 'GESER \u00a0/\u00a0 KLIK PLANET';
}

document.getElementById('btnPrev').addEventListener('click', () => {
    if (isStopped) {
        activeIdx = (activeIdx + 1) % N;
        updateDetailPanel(activeIdx);
    } else {
        orbitVelocity = Math.min(MAX_SPEED, Math.abs(orbitVelocity) + 0.04);
    }
});

document.getElementById('btnNext').addEventListener('click', () => {
    if (isStopped) {
        activeIdx = ((activeIdx - 1) + N) % N;
        updateDetailPanel(activeIdx);
    } else {
        orbitVelocity = -Math.min(MAX_SPEED, Math.abs(orbitVelocity) + 0.04);
    }
});

let dragX = null;
let lastDragX = null;
let lastDragT = null;
let dragVel = 0;
let dragTotalX = 0;

function startDrag(x) {
    dragX = x;
    lastDragX = x;
    lastDragT = performance.now();
    dragVel = 0;
    orbitVelocity = 0;
    dragTotalX = 0;
}

function moveDrag(x) {
    if (dragX === null) return;
    const now = performance.now();
    const dt = Math.max(1, now - lastDragT);
    const dx = x - lastDragX;

    dragTotalX += Math.abs(dx);

    if (dragTotalX > 5 && isStopped) {
        isStopped = false;
        updateStoppedUI(false);
    }

    dragVel = (dx / dt) * 10;
    dragVel = Math.max(-MAX_SPEED * 1.5, Math.min(MAX_SPEED * 1.5, dragVel));

    const W = ow.offsetWidth || 700;
    orbitAngle += dx * (TWO_PI / (W * 0.6));
    lastDragX = x;
    lastDragT = now;
}

function endDrag() {
    if (dragX === null) return;
    const W = ow.offsetWidth || 700;
    orbitVelocity = dragVel * (TWO_PI / (W * 0.6));

    const sign = orbitVelocity >= 0 ? 1 : -1;
    orbitVelocity = sign * Math.min(Math.abs(orbitVelocity), MAX_SPEED);

    if (Math.abs(orbitVelocity) < 0.001) orbitVelocity = sign * AUTO_SPEED;

    dragX = null;
}

ow.addEventListener('mousedown', e => startDrag(e.clientX));
window.addEventListener('mousemove', e => moveDrag(e.clientX));
window.addEventListener('mouseup', () => endDrag());
ow.addEventListener('touchstart', e => { startDrag(e.touches[0].clientX); }, { passive: true });
ow.addEventListener('touchmove', e => { moveDrag(e.touches[0].clientX); }, { passive: true });
ow.addEventListener('touchend', e => { endDrag(); }, { passive: true });

ow.addEventListener('wheel', e => {
    if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
        e.preventDefault();
        if (isStopped) {
            isStopped = false;
            updateStoppedUI(false);
        }
        orbitVelocity += (e.deltaX * 0.0006);
        orbitVelocity = Math.max(-MAX_SPEED, Math.min(MAX_SPEED, orbitVelocity));
    }
}, { passive: false });

window.addEventListener('keydown', e => {
    if (e.key === 'ArrowLeft' && !isStopped) orbitVelocity = -AUTO_SPEED * 3;
    if (e.key === 'ArrowRight' && !isStopped) orbitVelocity = AUTO_SPEED * 3;
    if (e.key === 'Escape' && isStopped) {
        isStopped = false;
        orbitVelocity = AUTO_SPEED;
        updateStoppedUI(false);
    }
});

function layout() {
    const W = ow.offsetWidth || 700;
    const cx = W / 2;
    const cy = 170;
    const rx = Math.min(W * 0.38, 240);
    const ry = 50;
    const THETA = TWO_PI / N;
    const frontI = isStopped ? activeIdx : frontIdx();

    canvases.forEach(({ slot, wrap, cnv, atmo }, i) => {
        const a = orbitAngle + i * THETA;
        const sx = cx + rx * Math.cos(a);
        const sy = cy + ry * Math.sin(a);
        const depth = (Math.sin(a) + 1) / 2;
        const sz = 72 + depth * 84;
        const op = 0.35 + depth * 0.65;
        const zIdx = Math.round(depth * 10);
        const isFront = i === frontI;

        wrap.style.width = sz + 'px';
        wrap.style.height = sz + 'px';

        const apad = 8;
        atmo.style.width = (sz + apad * 2) + 'px';
        atmo.style.height = (sz + apad * 2) + 'px';
        atmo.style.top = (-apad) + 'px';
        atmo.style.left = (-apad) + 'px';
        atmo.style.borderColor = MENUS[i].glow + '55';
        atmo.style.opacity = isFront ? '.7' : '0';

        wrap.classList.toggle('active', isFront);
        slot.style.cssText = `left:${sx}px;top:${sy}px;transform:translate(-50%,-50%);opacity:${op};z-index:${zIdx};pointer-events:auto;`;
    });

    Array.from(dotsEl.children).forEach((d, i) => d.classList.toggle('on', i === frontI));
    updateDetailPanel(frontI);
    if (!isStopped) activeIdx = frontI;
}

function tick() {
    if (!isStopped && dragX === null) {
        if (Math.abs(orbitVelocity) > AUTO_SPEED * 1.1) {
            const sign = orbitVelocity >= 0 ? 1 : -1;
            orbitVelocity *= FRICTION;
            if (Math.abs(orbitVelocity) < AUTO_SPEED) orbitVelocity = sign * AUTO_SPEED;
        } else {
            orbitVelocity += (AUTO_SPEED - orbitVelocity) * 0.04;
        }
        orbitAngle += orbitVelocity;
    }

    if (isStopped) {
        const target = snapAngleFor(activeIdx);
        const diff = target - orbitAngle;
        orbitVelocity += diff * 0.08;
        orbitVelocity *= 0.75;
        orbitAngle += orbitVelocity;
    }

    const speedRatio = Math.abs(orbitVelocity) / AUTO_SPEED;

    canvases.forEach(({ cnv }, i) => {
        if (renderers[i]) {
            renderers[i].setSpeed(isStopped ? 0 : renderers[i].baseSpeed * speedRatio);
            const frame = renderers[i].draw();
            const ctx = cnv.getContext('2d');
            ctx.clearRect(0, 0, PLANET_RES, PLANET_RES);
            ctx.drawImage(frame, 0, 0, PLANET_RES, PLANET_RES);
        }
    });

    layout();
    requestAnimationFrame(tick);
}

window.addEventListener('resize', layout);
updateDetailPanel(0);
requestAnimationFrame(tick);