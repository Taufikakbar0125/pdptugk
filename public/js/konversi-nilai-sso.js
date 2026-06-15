/* ===== Konversi Nilai SSO — JavaScript ===== */

// ── Password Toggle ──
(function initPasswordToggle() {
    const toggleBtn = document.getElementById('ssoTogglePw');
    const passwordInput = document.getElementById('ssoPassword');
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


// ── Toast Notification ──
function showToast(message, type = 'error') {
    // Remove existing toast
    const existing = document.querySelector('.toast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="toast-icon">
            ${type === 'error'
                ? '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>'
                : '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'
            }
        </div>
        <span>${message}</span>
    `;
    document.body.appendChild(toast);

    requestAnimationFrame(() => {
        requestAnimationFrame(() => toast.classList.add('show'));
    });

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
    }, 4000);
}


// ── Form Validation & Submit ──
(function initForm() {
    const form = document.getElementById('ssoLoginForm');
    const unyIdInput = document.getElementById('ssoUnyId');
    const passwordInput = document.getElementById('ssoPassword');
    const btnLogin = document.getElementById('btnSSOLogin');
    const btnClear = document.getElementById('btnSSOClear');

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

    // SSO Login submit
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        clearErrors();

        const idOk = validateField(unyIdInput, 'ssoUnyIdGroup');
        const pwOk = validateField(passwordInput, 'ssoPasswordGroup');

        if (!idOk || !pwOk) {
            showToast('Harap lengkapi semua field yang diperlukan.', 'error');
            return;
        }

        setLoading(btnLogin, true);

        // Simulate SSO login request
        setTimeout(() => {
            setLoading(btnLogin, false);
            // TODO: Replace with actual SSO endpoint call
            // window.location.href = 'https://sso.uny.ac.id/login?service=...';
            showToast('Login SSO berhasil! Mengarahkan...', 'success');

            // Simulate redirect delay
            setTimeout(() => {
                // TODO: Redirect to dashboard or konversi-nilai page
                // window.location.href = '/konversi-nilai/dashboard';
                showToast('Fitur SSO akan segera dihubungkan ke endpoint UNY.', 'error');
            }, 2000);
        }, 1800);
    });

    // Clear button
    if (btnClear) {
        btnClear.addEventListener('click', () => {
            clearErrors();
            unyIdInput.value = '';
            passwordInput.value = '';
            unyIdInput.focus();
        });
    }

    // Clear error on input
    [unyIdInput, passwordInput].forEach(input => {
        if (input) {
            input.addEventListener('input', () => {
                const group = input.closest('.input-group');
                if (group) group.classList.remove('error');
            });
        }
    });
})();


// ── Forgot Password ──
(function initForgotPw() {
    const link = document.getElementById('ssoForgotPwLink');
    if (!link) return;
    link.addEventListener('click', (e) => {
        e.preventDefault();
        // TODO: Navigate to SSO password reset
        showToast('Untuk reset password SSO, kunjungi password.ugk.ac.id', 'error');
    });
})();


// ── Input Focus Ripple Effect ──
(function initInputEffects() {
    document.querySelectorAll('.input-wrap input').forEach(input => {
        input.addEventListener('focus', () => {
            const wrap = input.closest('.input-wrap');
            wrap.style.transition = 'border-color .3s, box-shadow .3s, background .3s, transform .15s';
            wrap.style.transform = 'scale(1.01)';
        });
        input.addEventListener('blur', () => {
            const wrap = input.closest('.input-wrap');
            wrap.style.transform = 'scale(1)';
        });
    });
})();
