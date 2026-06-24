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


// ── Matrix Rain Background (Exact Match) ──
(function initMatrixRain() {
  var cv = document.getElementById('ilk-rain');
  if(!cv) return;
  var ctx = cv.getContext('2d');
  var W, H, cols, drops, colData;

  var KODE_PYTHON = ['import sys','def main():','print("Hello")','for i in range(10):','import numpy as np'];
  var MATKUL = ['Pemrograman','Basis Data','Sistem Operasi','Struktur Data','Kecerdasan Buatan'];
  var KODE_JAVA = ['public class Lab {','System.out.println();','Scanner sc = new Scanner(System.in);','int[] nilai = new int[40];'];
  var IP_DATA = ['192.168.10.','10.0.0.','172.16.1.','192.168.1.'];
  var HEX_CHARS = '0123456789ABCDEF';
  var BIN_CHARS  = '01';
  var ISTILAH = ['Algoritma','Rekursi','Pointer','Stack','Queue','Binary Tree','Hash Table','SQL Join'];
  var ARABIC_IT = ['علم الحاسوب','البيانات','الشبكة','الخوارزمية','قاعدة البيانات','الأمن المعلوماتي','البرمجة'];

  function randHex(n){var s='';for(var i=0;i<n;i++)s+=HEX_CHARS[Math.floor(Math.random()*16)];return s;}
  function randBin(n){var s='';for(var i=0;i<n;i++)s+=BIN_CHARS[Math.floor(Math.random()*2)];return s;}
  function randIP(){return IP_DATA[Math.floor(Math.random()*IP_DATA.length)]+Math.floor(Math.random()*254+1);}

  var TYPES = ['python','java','matkul','hex','binary','ip','istilah','arabic'];
  var COLORS = {
    python:  {head:'#ffffff',body:'#3b82f6', shadow:'rgba(59,130,246,'},
    java:    {head:'#ffffff',body:'#60a5fa', shadow:'rgba(96,165,250,'},
    matkul:  {head:'#ffe082',body:'#e2b714', shadow:'rgba(226,183,20,'},
    hex:     {head:'#ffffff',body:'#38bdf8', shadow:'rgba(56,189,248,'},
    binary:  {head:'#ffffff',body:'#818cf8', shadow:'rgba(129,140,248,'},
    ip:      {head:'#fffde7',body:'#93c5fd', shadow:'rgba(147,197,253,'},
    istilah: {head:'#ffffff',body:'#22d3ee', shadow:'rgba(34,211,238,'},
    arabic:  {head:'#ffe082',body:'#fbbf24', shadow:'rgba(251,191,36,'},
  };

  function getChar(type){
    switch(type){
      case 'python':  return KODE_PYTHON[Math.floor(Math.random()*KODE_PYTHON.length)];
      case 'java':    return KODE_JAVA[Math.floor(Math.random()*KODE_JAVA.length)];
      case 'matkul':  return MATKUL[Math.floor(Math.random()*MATKUL.length)];
      case 'hex':     return '0x'+randHex(4+Math.floor(Math.random()*4));
      case 'binary':  return randBin(8+Math.floor(Math.random()*8));
      case 'ip':      return randIP()+':'+[80,443,3306,22,8080,8443][Math.floor(Math.random()*6)];
      case 'istilah': return ISTILAH[Math.floor(Math.random()*ISTILAH.length)];
      case 'arabic':  return ARABIC_IT[Math.floor(Math.random()*ARABIC_IT.length)];
    }
  }

  var FS=12, LH=17;

  function init(){
    W = cv.width  = window.innerWidth;
    H = cv.height = window.innerHeight;
    cols    = Math.floor(W/(FS*9));
    drops   = [];
    colData = [];
    for(var i=0;i<cols;i++){
      var type=TYPES[Math.floor(Math.random()*TYPES.length)];
      var band=W/cols;
      drops.push(-(Math.random()*H/LH));
      colData.push({
        type:type, speed:.28+Math.random()*1.1,
        text:[], maxLen:7+Math.floor(Math.random()*20),
        x:i*band+Math.random()*(Math.max(band-FS*7,2)),
        opacity:.25+Math.random()*.65,
        size:FS*(.7+Math.random()*.55)
      });
    }
  }

  var resizeTimer;
  window.addEventListener('resize',function(){
    clearTimeout(resizeTimer);
    resizeTimer=setTimeout(function(){init();},200);
  });
  init();

  var frame=0;
  function draw(){
    frame++;
    ctx.fillStyle='rgba(1,8,20,.075)';
    ctx.fillRect(0,0,W,H);

    for(var i=0;i<cols;i++){
      var d=colData[i], c=COLORS[d.type];
      ctx.font=d.size+'px "JetBrains Mono",monospace';
      ctx.textAlign='left';

      if(frame%Math.ceil(3.5/d.speed)===i%4){
        d.text.push(getChar(d.type));
        if(d.text.length>d.maxLen) d.text.shift();
      }

      var yCursor=drops[i]*LH;
      for(var j=d.text.length-1;j>=0;j--){
        var age=d.text.length-1-j;
        var yPos=yCursor-age*LH;
        if(yPos<-LH||yPos>H+LH) continue;
        if(age===0){
          ctx.shadowBlur=12; ctx.shadowColor=c.shadow+'0.8)';
          ctx.fillStyle=c.head; ctx.globalAlpha=d.opacity;
        } else {
          var a=d.opacity*Math.pow(.80,age);
          ctx.shadowBlur=age<3?5:0; ctx.shadowColor=c.shadow+'0.35)';
          ctx.fillStyle=c.body; ctx.globalAlpha=Math.max(0,Math.min(1,a));
        }
        ctx.fillText(d.text[d.text.length-1-age],d.x,yPos);
      }
      ctx.globalAlpha=1; ctx.shadowBlur=0;

      drops[i]+=d.speed;
      if(drops[i]*LH>H+d.maxLen*LH){
        drops[i]=-(Math.random()*22);
        d.text=[];
        d.type=TYPES[Math.floor(Math.random()*TYPES.length)];
        d.speed=.28+Math.random()*1.1;
        d.opacity=.25+Math.random()*.65;
        d.size=FS*(.7+Math.random()*.55);
        var band=W/cols;
        d.x=i*band+Math.random()*(Math.max(band-FS*7,2));
      }
    }
    requestAnimationFrame(draw);
  }
  draw();
})();
