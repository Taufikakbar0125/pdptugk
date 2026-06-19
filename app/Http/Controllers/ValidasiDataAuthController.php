<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpVerificationMail;
use App\Mail\ResetPasswordOtpMail;

class ValidasiDataAuthController extends Controller
{
    /**
     * Proses form registrasi: validasi captcha, generate OTP, kirim email, simpan session.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nim'              => 'required|string|max:20',
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|max:150',
            'password'         => 'required|string|min:8|same:confirm_password',
            'confirm_password' => 'required|string|min:8',
            'captcha'          => 'required|captcha',
        ], [
            'nim.required'              => 'NIM wajib diisi.',
            'name.required'             => 'Nama lengkap wajib diisi.',
            'email.required'            => 'Alamat email wajib diisi.',
            'email.email'               => 'Format email tidak valid.',
            'password.required'         => 'Kata sandi wajib diisi.',
            'password.min'              => 'Kata sandi minimal 8 karakter.',
            'password.same'             => 'Konfirmasi kata sandi tidak cocok.',
            'confirm_password.required' => 'Konfirmasi kata sandi wajib diisi.',
            'captcha.required'          => 'Kode CAPTCHA wajib diisi.',
            'captcha.captcha'           => 'Kode CAPTCHA tidak valid. Silakan coba lagi.',
        ]);

        // Generate OTP 6 digit
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(10);

        // Simpan data registrasi dan OTP ke session
        $request->session()->put('reg_data', [
            'nim'      => $request->nim,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);
        $request->session()->put('otp', $otp);
        $request->session()->put('otp_expires_at', $expiresAt->timestamp);
        $request->session()->put('otp_email', $request->email);

        // Kirim email OTP
        Mail::to($request->email)->send(new OtpVerificationMail($otp, $request->name));

        return redirect()->route('validasi-data.verify-otp')
            ->with('success', 'Kode OTP telah dikirim ke email ' . $request->email);
    }

    /**
     * Tampilkan halaman input OTP.
     */
    public function showVerifyOtp(Request $request)
    {
        if (!$request->session()->has('reg_data')) {
            return redirect()->route('validasi-data.register.view')
                ->with('error', 'Sesi pendaftaran tidak ditemukan. Silakan daftar ulang.');
        }
        return view('validasi-data.verify-otp', [
            'email' => $request->session()->get('otp_email'),
        ]);
    }

    /**
     * Verifikasi kode OTP yang diinput oleh user.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.size'     => 'Kode OTP harus 6 digit.',
        ]);

        if (!$request->session()->has('otp') || !$request->session()->has('reg_data')) {
            return redirect()->route('validasi-data.register.view')
                ->with('error', 'Sesi tidak valid. Silakan daftar ulang.');
        }

        // Cek expired
        $expiresAt = $request->session()->get('otp_expires_at');
        if (now()->timestamp > $expiresAt) {
            $request->session()->forget(['otp', 'reg_data', 'otp_expires_at', 'otp_email']);
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa. Silakan daftar ulang.']);
        }

        // Cek kode OTP
        if ($request->otp !== $request->session()->get('otp')) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid. Periksa kembali email Anda.']);
        }

        // OTP benar — ambil data registrasi, hapus session
        $regData = $request->session()->get('reg_data');
        $request->session()->forget(['otp', 'reg_data', 'otp_expires_at', 'otp_email']);

        // Simpan $regData ke database
        $user = \App\Models\User::create([
            'name' => $regData['name'],
            'email' => $regData['email'],
            'password' => $regData['password'],
            'role' => 'mahasiswa',
            'identifier' => $regData['nim'],
            'email_verified_at' => now(),
        ]);

        return redirect()->route('validasi-data.register.success')
            ->with('success_name', $regData['name']);
    }

    /**
     * Kirim ulang kode OTP.
     */
    public function resendOtp(Request $request)
    {
        if (!$request->session()->has('reg_data')) {
            return redirect()->route('validasi-data.register.view')
                ->with('error', 'Sesi pendaftaran tidak ditemukan. Silakan daftar ulang.');
        }

        $regData  = $request->session()->get('reg_data');
        $otp      = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(10);

        $request->session()->put('otp', $otp);
        $request->session()->put('otp_expires_at', $expiresAt->timestamp);

        Mail::to($regData['email'])->send(new OtpVerificationMail($otp, $regData['name']));

        return back()->with('success', 'Kode OTP baru telah dikirim ulang ke ' . $regData['email']);
    }

    /**
     * Tampilkan halaman sukses pendaftaran.
     */
    public function registerSuccess(Request $request)
    {
        if (!$request->session()->has('success_name')) {
            return redirect('/validasi-data/login');
        }
        return view('validasi-data.register-success', [
            'name' => $request->session()->pull('success_name'),
        ]);
    }

    /**
     * Tampilkan form login mahasiswa.
     */
    public function showLoginForm()
    {
        if (\Auth::check() && \Auth::user()->role === 'mahasiswa') {
            return redirect()->route('validasi-data.dashboard');
        }
        return view('validasi-data.login');
    }

    /**
     * Proses login mahasiswa (NIM atau Email).
     */
    public function login(Request $request)
    {
        $request->validate([
            'login_key' => 'required|string',
            'password'  => 'required|string',
        ], [
            'login_key.required' => 'NIM atau Alamat Email wajib diisi.',
            'password.required'  => 'Kata sandi wajib diisi.',
        ]);

        $loginKey = $request->login_key;
        $field = filter_var($loginKey, FILTER_VALIDATE_EMAIL) ? 'email' : 'identifier';

        if (\Auth::attempt([$field => $loginKey, 'password' => $request->password, 'role' => 'mahasiswa'])) {
            $request->session()->regenerate();
            return redirect()->route('validasi-data.dashboard');
        }

        return back()->withErrors([
            'login_key' => 'NIM/Email atau kata sandi Anda salah.',
        ])->withInput($request->only('login_key'));
    }

    /**
     * Logout mahasiswa.
     */
    public function logout(Request $request)
    {
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/validasi-data/login')->with('success', 'Anda telah berhasil keluar.');
    }

    /**
     * Halaman Dashboard Mahasiswa.
     */
    public function dashboard()
    {
        $user = \Auth::user();
        $requests = \App\Models\PengajuanValidasi::where('user_id', $user->id)->with(['jenisMasalah', 'pengajuanDokumens'])->latest()->get();
        $jenisMasalah = \App\Models\JenisMasalah::with('dokumenPersyaratans')->orderBy('nama_masalah', 'asc')->get();

        return view('validasi-data.dashboard', compact('user', 'requests', 'jenisMasalah'));
    }

    /**
     * Simpan pengajuan perubahan data baru.
     */
    public function storeRequest(Request $request)
    {
        $rules = [
            'nama'             => 'required|string|max:100',
            'nim'              => 'required|string|max:20',
            'prodi'            => 'required|string|max:100',
            'fakultas'         => 'required|string|max:100',
            'angkatan'         => 'required|string|max:10',
            'no_hp'            => 'required|string|max:20',
            'email'            => 'required|email|max:150',
            'jenis_masalah_id' => 'required|exists:jenis_masalahs,id',
            'keterangan'       => 'nullable|string|max:1000',
        ];

        $messages = [
            'nama.required'             => 'Nama Lengkap wajib diisi.',
            'nim.required'              => 'NIM wajib diisi.',
            'prodi.required'            => 'Program Studi wajib diisi.',
            'fakultas.required'         => 'Fakultas wajib diisi.',
            'angkatan.required'         => 'Angkatan wajib diisi.',
            'no_hp.required'            => 'Nomor HP wajib diisi.',
            'email.required'            => 'Alamat Email wajib diisi.',
            'email.email'               => 'Format email tidak valid.',
            'jenis_masalah_id.required' => 'Jenis Masalah wajib dipilih.',
            'jenis_masalah_id.exists'   => 'Jenis Masalah tidak valid.',
            'keterangan.max'            => 'Keterangan maksimal 1000 karakter.',
        ];

        $jenisMasalah = null;
        if ($request->filled('jenis_masalah_id')) {
            $jenisMasalah = \App\Models\JenisMasalah::with('dokumenPersyaratans')->find($request->jenis_masalah_id);
            if ($jenisMasalah) {
                foreach ($jenisMasalah->dokumenPersyaratans as $doc) {
                    $inputKey = 'bukti_files.' . $doc->id;
                    $rules[$inputKey] = [$doc->is_wajib ? 'required' : 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'];
                    
                    if ($doc->is_wajib) {
                        $messages[$inputKey . '.required'] = 'Dokumen "' . $doc->nama_dokumen . '" wajib diunggah.';
                    }
                    $messages[$inputKey . '.file'] = 'Berkas "' . $doc->nama_dokumen . '" harus berupa file.';
                    $messages[$inputKey . '.mimes'] = 'Berkas "' . $doc->nama_dokumen . '" harus berformat PDF, JPG, JPEG, atau PNG.';
                    $messages[$inputKey . '.max'] = 'Berkas "' . $doc->nama_dokumen . '" maksimal berukuran 2MB.';
                }
            }
        }

        $request->validate($rules, $messages);

        $pengajuan = \App\Models\PengajuanValidasi::create([
            'user_id'          => \Auth::id(),
            'nama'             => $request->nama,
            'nim'              => $request->nim,
            'prodi'            => $request->prodi,
            'fakultas'         => $request->fakultas,
            'angkatan'         => $request->angkatan,
            'no_hp'            => $request->no_hp,
            'email'            => $request->email,
            'jenis_masalah_id' => $request->jenis_masalah_id,
            'keterangan'       => $request->keterangan,
            'status'           => 'data di terima',
        ]);

        if ($jenisMasalah) {
            foreach ($jenisMasalah->dokumenPersyaratans as $doc) {
                $inputName = 'bukti_files.' . $doc->id;
                if ($request->hasFile($inputName)) {
                    $path = $request->file($inputName)->store('uploads/bukti', 'public');
                    $pengajuan->pengajuanDokumens()->create([
                        'nama_dokumen' => $doc->nama_dokumen,
                        'file_path'    => $path,
                        'is_wajib'     => $doc->is_wajib,
                    ]);
                }
            }
        }

        return back()->with('success', 'Pengajuan perubahan data Anda berhasil dikirim dan akan segera diproses oleh Admin.');
    }

    /**
     * Tampilkan form edit pengajuan (hanya jika status dikembalikan untuk diperbarui).
     */
    public function editRequest($id)
    {
        $user = \Auth::user();
        $pengajuan = \App\Models\PengajuanValidasi::where('user_id', $user->id)
            ->with(['jenisMasalah', 'pengajuanDokumens'])
            ->findOrFail($id);

        if ($pengajuan->status !== 'data dikembalikan untuk diperbarui') {
            return redirect()->route('validasi-data.dashboard')
                ->with('error', 'Pengajuan ini tidak dapat diedit karena statusnya bukan dikembalikan.');
        }

        $jenisMasalah = \App\Models\JenisMasalah::with('dokumenPersyaratans')->orderBy('nama_masalah', 'asc')->get();

        return view('validasi-data.edit', compact('user', 'pengajuan', 'jenisMasalah'));
    }

    /**
     * Proses pembaruan data pengajuan revisi.
     */
    public function updateRequest(Request $request, $id)
    {
        $user = \Auth::user();
        $pengajuan = \App\Models\PengajuanValidasi::where('user_id', $user->id)->findOrFail($id);

        if ($pengajuan->status !== 'data dikembalikan untuk diperbarui') {
            return redirect()->route('validasi-data.dashboard')
                ->with('error', 'Pengajuan ini tidak dapat diperbarui.');
        }

        $rules = [
            'nama'             => 'required|string|max:100',
            'nim'              => 'required|string|max:20',
            'prodi'            => 'required|string|max:100',
            'fakultas'         => 'required|string|max:100',
            'angkatan'         => 'required|string|max:10',
            'no_hp'            => 'required|string|max:20',
            'email'            => 'required|email|max:150',
            'jenis_masalah_id' => 'required|exists:jenis_masalahs,id',
            'keterangan'       => 'nullable|string|max:1000',
        ];

        $messages = [
            'nama.required'             => 'Nama Lengkap wajib diisi.',
            'nim.required'              => 'NIM wajib diisi.',
            'prodi.required'            => 'Program Studi wajib diisi.',
            'fakultas.required'         => 'Fakultas wajib diisi.',
            'angkatan.required'         => 'Angkatan wajib diisi.',
            'no_hp.required'            => 'Nomor HP wajib diisi.',
            'email.required'            => 'Alamat Email wajib diisi.',
            'email.email'               => 'Format email tidak valid.',
            'jenis_masalah_id.required' => 'Jenis Masalah wajib dipilih.',
            'jenis_masalah_id.exists'   => 'Jenis Masalah tidak valid.',
            'keterangan.max'            => 'Keterangan maksimal 1000 karakter.',
        ];

        $isCategoryChanged = ($pengajuan->jenis_masalah_id != $request->jenis_masalah_id);

        $jenisMasalah = null;
        if ($request->filled('jenis_masalah_id')) {
            $jenisMasalah = \App\Models\JenisMasalah::with('dokumenPersyaratans')->find($request->jenis_masalah_id);
            if ($jenisMasalah) {
                foreach ($jenisMasalah->dokumenPersyaratans as $doc) {
                    $inputKey = 'bukti_files.' . $doc->id;
                    
                    $hasExistingDoc = false;
                    if (!$isCategoryChanged) {
                        $hasExistingDoc = $pengajuan->pengajuanDokumens()->where('nama_dokumen', $doc->nama_dokumen)->exists();
                    }

                    $fileRules = [];
                    if ($doc->is_wajib && !$hasExistingDoc) {
                        $fileRules[] = 'required';
                    } else {
                        $fileRules[] = 'nullable';
                    }
                    $fileRules = array_merge($fileRules, ['file', 'mimes:pdf,jpg,jpeg,png', 'max:2048']);
                    
                    $rules[$inputKey] = $fileRules;
                    
                    if ($doc->is_wajib && !$hasExistingDoc) {
                        $messages[$inputKey . '.required'] = 'Dokumen "' . $doc->nama_dokumen . '" wajib diunggah.';
                    }
                    $messages[$inputKey . '.file'] = 'Berkas "' . $doc->nama_dokumen . '" harus berupa file.';
                    $messages[$inputKey . '.mimes'] = 'Berkas "' . $doc->nama_dokumen . '" harus berformat PDF, JPG, JPEG, atau PNG.';
                    $messages[$inputKey . '.max'] = 'Berkas "' . $doc->nama_dokumen . '" maksimal berukuran 2MB.';
                }
            }
        }

        $request->validate($rules, $messages);

        if ($isCategoryChanged) {
            foreach ($pengajuan->pengajuanDokumens as $oldDoc) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldDoc->file_path);
                $oldDoc->delete();
            }
        }

        $pengajuan->update([
            'nama'             => $request->nama,
            'nim'              => $request->nim,
            'prodi'            => $request->prodi,
            'fakultas'         => $request->fakultas,
            'angkatan'         => $request->angkatan,
            'no_hp'            => $request->no_hp,
            'email'            => $request->email,
            'jenis_masalah_id' => $request->jenis_masalah_id,
            'keterangan'       => $request->keterangan,
            'status'           => 'data di terima',
        ]);

        if ($jenisMasalah) {
            foreach ($jenisMasalah->dokumenPersyaratans as $doc) {
                $inputName = 'bukti_files.' . $doc->id;
                if ($request->hasFile($inputName)) {
                    $existingDoc = $pengajuan->pengajuanDokumens()->where('nama_dokumen', $doc->nama_dokumen)->first();
                    if ($existingDoc) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($existingDoc->file_path);
                        $existingDoc->delete();
                    }

                    $path = $request->file($inputName)->store('uploads/bukti', 'public');
                    $pengajuan->pengajuanDokumens()->create([
                        'nama_dokumen' => $doc->nama_dokumen,
                        'file_path'    => $path,
                        'is_wajib'     => $doc->is_wajib,
                    ]);
                }
            }
        }

        return redirect()->route('validasi-data.dashboard')->with('success', 'Pengajuan berhasil diperbarui dan dikirim kembali untuk ditinjau ulang oleh Admin.');
    }

    // ═══════════════════════════════════════════════════
    // LUPA KATA SANDI — Secure Reset via OTP
    // ═══════════════════════════════════════════════════

    /**
     * Tampilkan form lupa kata sandi.
     */
    public function showForgotPassword()
    {
        return view('validasi-data.lupa-password');
    }

    /**
     * Proses form lupa kata sandi: validasi NIM + email + captcha, kirim OTP.
     * Response selalu timing-safe (sama baik user ditemukan maupun tidak).
     */
    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'nim'     => 'required|string|max:20',
            'email'   => 'required|email|max:150',
            'captcha' => 'required|captcha',
        ], [
            'nim.required'     => 'NIM wajib diisi.',
            'email.required'   => 'Alamat email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'captcha.required' => 'Kode CAPTCHA wajib diisi.',
            'captcha.captcha'  => 'Kode CAPTCHA tidak valid. Silakan coba lagi.',
        ]);

        // Cari user by NIM (identifier) + email + role mahasiswa
        $user = \App\Models\User::where('identifier', $request->nim)
            ->where('email', $request->email)
            ->where('role', 'mahasiswa')
            ->first();

        if ($user) {
            // User ditemukan — generate OTP dan kirim email
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $expiresAt = now()->addMinutes(10);

            $request->session()->put('reset_otp', $otp);
            $request->session()->put('reset_otp_expires_at', $expiresAt->timestamp);
            $request->session()->put('reset_otp_email', $request->email);
            $request->session()->put('reset_otp_user_id', $user->id);
            $request->session()->put('reset_otp_attempts', 0);

            Mail::to($request->email)->send(new ResetPasswordOtpMail($otp, $user->name));
        }

        // TIMING-SAFE: selalu redirect ke halaman OTP dengan pesan yang sama,
        // baik user ditemukan maupun tidak. Penyerang tidak bisa tahu.
        return redirect()->route('validasi-data.reset-verify-otp')
            ->with('success', 'Jika NIM dan email terdaftar di sistem, kode OTP telah dikirim ke email Anda.');
    }

    /**
     * Tampilkan halaman input OTP reset password.
     */
    public function showResetOtpForm(Request $request)
    {
        // Jika tidak ada session reset, redirect
        $email = $request->session()->get('reset_otp_email');
        return view('validasi-data.reset-verify-otp', [
            'email' => $email,
        ]);
    }

    /**
     * Verifikasi kode OTP reset password (max 5 attempts).
     */
    public function verifyResetOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.size'     => 'Kode OTP harus 6 digit.',
        ]);

        // Cek session
        if (!$request->session()->has('reset_otp') || !$request->session()->has('reset_otp_user_id')) {
            return redirect()->route('validasi-data.forgot-password')
                ->with('error', 'Sesi tidak valid. Silakan ulangi proses reset kata sandi.');
        }

        // Cek brute-force: max 5 attempts
        $attempts = $request->session()->get('reset_otp_attempts', 0);
        if ($attempts >= 5) {
            $request->session()->forget(['reset_otp', 'reset_otp_expires_at', 'reset_otp_email', 'reset_otp_user_id', 'reset_otp_attempts']);
            return redirect()->route('validasi-data.forgot-password')
                ->with('error', 'Terlalu banyak percobaan salah. Silakan ulangi proses reset dari awal.');
        }

        // Cek expired
        $expiresAt = $request->session()->get('reset_otp_expires_at');
        if (now()->timestamp > $expiresAt) {
            $request->session()->forget(['reset_otp', 'reset_otp_expires_at', 'reset_otp_email', 'reset_otp_user_id', 'reset_otp_attempts']);
            return redirect()->route('validasi-data.forgot-password')
                ->with('error', 'Kode OTP sudah kadaluarsa. Silakan ulangi proses reset kata sandi.');
        }

        // Cek kode OTP
        if ($request->otp !== $request->session()->get('reset_otp')) {
            $request->session()->put('reset_otp_attempts', $attempts + 1);
            $remaining = 5 - ($attempts + 1);
            return back()->withErrors(['otp' => "Kode OTP tidak valid. Sisa percobaan: {$remaining}x."]);
        }

        // OTP benar — tandai verified, hapus OTP dari session
        $request->session()->put('reset_otp_verified', true);
        $request->session()->forget(['reset_otp', 'reset_otp_expires_at', 'reset_otp_attempts']);

        return redirect()->route('validasi-data.reset-password');
    }

    /**
     * Tampilkan form password baru.
     */
    public function showNewPasswordForm(Request $request)
    {
        // Hanya bisa diakses jika OTP sudah terverifikasi
        if (!$request->session()->get('reset_otp_verified')) {
            return redirect()->route('validasi-data.forgot-password')
                ->with('error', 'Akses tidak valid. Silakan ulangi proses reset kata sandi.');
        }

        return view('validasi-data.reset-password');
    }

    /**
     * Simpan password baru.
     */
    public function resetPassword(Request $request)
    {
        // Cek session verified
        if (!$request->session()->get('reset_otp_verified') || !$request->session()->has('reset_otp_user_id')) {
            return redirect()->route('validasi-data.forgot-password')
                ->with('error', 'Sesi tidak valid. Silakan ulangi proses reset kata sandi.');
        }

        $request->validate([
            'password'         => 'required|string|min:8|same:confirm_password',
            'confirm_password' => 'required|string|min:8',
        ], [
            'password.required'         => 'Kata sandi baru wajib diisi.',
            'password.min'              => 'Kata sandi minimal 8 karakter.',
            'password.same'             => 'Konfirmasi kata sandi tidak cocok.',
            'confirm_password.required' => 'Konfirmasi kata sandi wajib diisi.',
        ]);

        $userId = $request->session()->get('reset_otp_user_id');
        $user = \App\Models\User::find($userId);

        if (!$user) {
            return redirect()->route('validasi-data.forgot-password')
                ->with('error', 'Akun tidak ditemukan. Silakan ulangi proses.');
        }

        // Update password
        $user->update([
            'password' => $request->password,
        ]);

        // Bersihkan semua session reset
        $request->session()->forget(['reset_otp_verified', 'reset_otp_user_id', 'reset_otp_email']);

        // Regenerate session untuk keamanan
        $request->session()->regenerate();

        return redirect()->route('validasi-data.login')
            ->with('success', '✅ Kata sandi berhasil direset! Silakan login dengan kata sandi baru Anda.');
    }
}
