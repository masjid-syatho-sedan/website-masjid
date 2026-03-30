<x-layouts::base :title="'Daftar Akun Masjid'" active="portal">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --warna-utama: #1e7e34;
            --warna-utama-gelap: #165c2d;
            --warna-aksen: #f59e0b;
            --warna-background: #ffffff;
            --warna-border: #e5e7eb;
            --teks-utama: #1f2937;
            --teks-ringan: #6b7280;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            position: relative;
            overflow: hidden;
            padding: 2rem 0;
        }

        .register-container::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(30, 126, 52, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            pointer-events: none;
        }

        .register-container::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            pointer-events: none;
        }

        .register-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            padding: 2rem;
        }

        .register-card {
            background: var(--warna-background);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(30, 126, 52, 0.08);
            border: 1px solid rgba(30, 126, 52, 0.1);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--warna-utama) 0%, var(--warna-utama-gelap) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 30px;
        }

        .register-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--teks-utama);
            margin: 0 0 0.5rem 0;
        }

        .register-header p {
            color: var(--teks-ringan);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        .register-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .form-group label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--teks-utama);
            display: block;
        }

        .form-group input {
            padding: 0.95rem 1rem;
            border: 1.5px solid var(--warna-border);
            border-radius: 10px;
            font-size: 0.95rem;
            color: var(--teks-utama);
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--warna-utama);
            background: var(--warna-background);
            box-shadow: 0 0 0 3px rgba(30, 126, 52, 0.1);
        }

        .form-group input::placeholder {
            color: var(--teks-ringan);
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--warna-utama) 0%, var(--warna-utama-gelap) 100%);
            color: white;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            box-shadow: 0 10px 25px rgba(30, 126, 52, 0.2);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(30, 126, 52, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .login-prompt {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--warna-border);
            font-size: 0.875rem;
            color: var(--teks-ringan);
        }

        .login-prompt a {
            color: var(--warna-utama);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-prompt a:hover {
            color: var(--warna-utama-gelap);
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
            color: var(--teks-ringan);
            font-size: 0.8rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--warna-border);
        }

        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.9rem 1.5rem;
            border: 1.5px solid var(--warna-border);
            border-radius: 10px;
            background: #fff;
            color: var(--teks-utama);
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .google-btn:hover {
            border-color: #4285f4;
            background: #f8f9ff;
            box-shadow: 0 4px 16px rgba(66, 133, 244, 0.15);
            transform: translateY(-1px);
        }

        .google-btn svg {
            flex-shrink: 0;
        }

        .status-message {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border: 1.5px solid #6ee7b7;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: #059669;
            font-size: 0.875rem;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-message {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 1.5px solid #fca5a5;
            border-radius: 10px;
            padding: 1rem;
            color: #dc2626;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        .error-field {
            border-color: #ef4444 !important;
        }

        .error-text {
            color: #dc2626;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        @media (max-width: 640px) {
            .register-wrapper {
                padding: 1rem;
            }

            .register-card {
                padding: 2rem 1.5rem;
                border-radius: 16px;
            }

            .register-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="register-container">
        <div class="register-wrapper">
            <div class="register-card">
                <!-- Header -->
                <div class="register-header">
                    <div class="logo-icon">🕌</div>
                    <h1>Daftar Akun</h1>
                    <p>Buat akun untuk bergabung dengan Portal Masjid</p>
                </div>

                <!-- Pesan Sukses -->
                @if (session('status'))
                    <div class="status-message">
                        ✓ {{ session('status') }}
                    </div>
                @endif

                <!-- Pesan Error -->
                @if ($errors->any())
                    <div class="error-message">
                        <strong>⚠️ Ada Masalah</strong><br>
                        Silakan periksa kembali data yang Anda masukkan
                    </div>
                @endif

                <!-- Form Daftar -->
                <form method="POST" action="{{ route('register.store') }}" class="register-form">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Nama Anda"
                            class="{{ $errors->has('name') ? 'error-field' : '' }}"
                        />
                        @error('name')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="nama@email.com"
                            class="{{ $errors->has('email') ? 'error-field' : '' }}"
                        />
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kata Sandi -->
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="{{ $errors->has('password') ? 'error-field' : '' }}"
                        />
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="{{ $errors->has('password_confirmation') ? 'error-field' : '' }}"
                        />
                        @error('password_confirmation')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tombol Daftar -->
                    <button type="submit" class="submit-btn" data-test="register-user-button">
                        Buat Akun Sekarang
                    </button>
                </form>

                <!-- Daftar dengan Google -->
                <div class="divider">atau</div>
                <a href="{{ route('auth.google') }}" class="google-btn">
                    <svg width="20" height="20" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M47.532 24.552c0-1.636-.145-3.2-.418-4.698H24.48v9.01h12.958c-.572 2.98-2.26 5.504-4.77 7.198v5.986h7.698c4.506-4.15 7.166-10.268 7.166-17.496z" fill="#4285F4"/>
                        <path d="M24.48 48c6.495 0 11.943-2.152 15.924-5.832l-7.698-5.986c-2.15 1.44-4.898 2.288-8.226 2.288-6.326 0-11.682-4.272-13.596-10.01H3.002v6.18C6.967 42.888 15.153 48 24.48 48z" fill="#34A853"/>
                        <path d="M10.884 28.46A14.434 14.434 0 0 1 10.1 24c0-1.564.27-3.086.784-4.46v-6.18H3.002A23.98 23.98 0 0 0 .48 24c0 3.874.926 7.538 2.522 10.64l7.882-6.18z" fill="#FBBC05"/>
                        <path d="M24.48 9.532c3.564 0 6.762 1.224 9.282 3.632l6.948-6.948C36.416 2.39 30.974 0 24.48 0 15.153 0 6.967 5.112 3.002 13.36l7.882 6.18c1.914-5.738 7.27-10.008 13.596-10.008z" fill="#EA4335"/>
                    </svg>
                    Daftar dengan Google
                </a>

                <!-- Link Masuk -->
                <div class="login-prompt">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" wire:navigate>Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts::base>