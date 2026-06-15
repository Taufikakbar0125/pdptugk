/* ===== Konversi Nilai Login — JavaScript ===== */

// ── Starfield Background ──
(function initStarfield() {
    const canvas = document.getElementById('starfield');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let W, H;
    const STAR_COUNT = 160;
    let stars = [];

    function resize() {
        W = canvas.width = window.innerWidth;
        H = canvas.height = window.innerHeight;
    }

    function createStar() {
        return {
            x: Math.random() * W,
            y: Math.random() * H,
            r: Math.random() * 1.2 + 0.2,
            alpha: Math.random() * 0.6 + 0.15,
            twinkleSpeed: Math.random() * 3 + 2,
            twinklePhase: Math.random() * Math.PI * 2
        };
    }

    function init() {
        resize();
        stars = Array.from({ length: STAR_COUNT }, createStar);
    }

    function draw(time) {
        const t = time * 0.001;
        ctx.clearRect(0, 0, W, H);

        // Subtle nebula glow
        const grad = ctx.createRadialGradient(W * 0.5, H * 0.4, 0, W * 0.5, H * 0.4, Math.max(W, H) * 0.55);
        grad.addColorStop(0, 'rgba(20,60,40,.12)');
        grad.addColorStop(1, 'rgba(6,13,26,0)');
        ctx.fillStyle = grad;
        ctx.fillRect(0, 0, W, H);

        stars.forEach(s => {
            const a = s.alpha * (0.5 + 0.5 * Math.sin(t / s.twinkleSpeed + s.twinklePhase));
            ctx.beginPath();
            ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(160,240,190,${a})`;
            ctx.fill();
        });

        requestAnimationFrame(draw);
    }

    init();
    window.addEventListener('resize', () => {
        resize();
        stars = Array.from({ length: STAR_COUNT }, createStar);
    });
    requestAnimationFrame(draw);
})();


// ── Password Toggle ──
(function initPasswordToggle() {
    const toggleBtn = document.getElementById('togglePw');
    const passwordInput = document.getElementById('password');
    if (!toggleBtn || !passwordInput) return;

    const eyeOpen = toggleBtn.querySelector('.eye-open');
    const eyeClosed = toggleBtn.querySelector('.eye-closed');

    toggleBtn.addEventListener('click', () => {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        eyeOpen.style.display = isPassword ? 'none' : 'block';
        eyeClosed.style.display = isPassword ? 'block' : 'none';
        toggleBtn.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
    });
})();


// ── Form Validation & Submit ──
(function initForm() {
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const btnAdmin = document.getElementById('btnLoginAdmin');
    const btnSSO = document.getElementById('btnLoginSSO');

    if (!form) return;

    function clearErrors() {
        document.querySelectorAll('.input-group.error').forEach(g => g.classList.remove('error'));
    }

    function validateField(input, groupId) {
        const group = document.getElementById(groupId);
        if (!input.value.trim()) {
            group.classList.add('error');
            return false;
        }
        group.classList.remove('error');
        return true;
    }

    function setLoading(btn, loading) {
        if (loading) {
            btn.classList.add('loading');
        } else {
            btn.classList.remove('loading');
        }
    }

    // Admin login
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        clearErrors();

        const emailOk = validateField(emailInput, 'emailGroup');
        const pwOk = validateField(passwordInput, 'passwordGroup');

        if (!emailOk || !pwOk) return;

        setLoading(btnAdmin, true);

        // Simulate login request (replace with actual AJAX call later)
        setTimeout(() => {
            setLoading(btnAdmin, false);
            // TODO: Handle actual admin login
            alert('Login Admin — fitur ini akan segera dihubungkan ke backend.');
        }, 1500);
    });

    // SSO login — redirect to SSO page
    if (btnSSO) {
        btnSSO.addEventListener('click', () => {
            window.location.href = '/konversi-nilai/sso';
        });
    }

    // Clear error on input
    [emailInput, passwordInput].forEach(input => {
        if (input) {
            input.addEventListener('input', () => {
                const group = input.closest('.input-group');
                if (group) group.classList.remove('error');
            });
        }
    });
})();


// ── Forgot Password Link ──
(function initForgotPw() {
    const link = document.getElementById('forgotPwLink');
    if (!link) return;
    link.addEventListener('click', (e) => {
        e.preventDefault();
        // TODO: Navigate to forgot password page
        alert('Fitur reset password akan segera tersedia.');
    });
})();
