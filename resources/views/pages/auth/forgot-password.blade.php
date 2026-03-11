<x-layouts::base :title="'Lupa Kata Sandi'" active="portal">
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

        .forgot-password-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            position: relative;
            overflow: hidden;
            padding: 2rem 0;
        }

        .forgot-password-container::before {
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

        .forgot-password-container::after {
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

        .forgot-password-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            padding: 2rem;
        }

        .forgot-password-card {
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

        .forgot-password-header {
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

        .forgot-password-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--teks-utama);
            margin: 0 0 0.5rem 0;
        }

        .forgot-password-header p {
            color: var(--teks-ringan);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        .forgot-password-form {
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

        .back-to-login {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--warna-border);
            font-size: 0.875rem;
            color: var(--teks-ringan);
        }

        .back-to-login a {
            color: var(--warna-utama);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-to-login a:hover {
            color: var(--warna-utama-gelap);
            text-decoration: underline;
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

        .info-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 1.5px solid #fcd34d;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: #92400e;
            font-size: 0.875rem;
            line-height: 1.6;
        }

        .info-box strong {
            display: block;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 640px) {
            .forgot-password-wrapper {
                padding: 1rem;
            }

            .forgot-password-card {
                padding: 2rem 1.5rem;
                border-radius: 16px;
            }

            .forgot-password-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="forgot-password-container">
        <div class="forgot-password-wrapper">
            <div class="forgot-password-card">
                <!-- Header -->
                <div class="forgot-password-header">
                    <div class="logo-icon">🔑</div>
                    <h1>Lupa Kata Sandi</h1>
                    <p>Masukkan email Anda untuk menerima link reset kata sandi</p>
                </div>

                <!-- Info Box -->
                <div class="info-box">
                    <strong>💡 Panduan:</strong>
                    Kami akan mengirimkan link reset kata sandi ke email Anda. Gunakan link tersebut untuk membuat kata sandi baru.
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
                        Silakan periksa kembali email yang Anda masukkan
                    </div>
                @endif

                <!-- Form Forgot Password -->
                <form method="POST" action="{{ route('password.email') }}" class="forgot-password-form">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="nama@email.com"
                            class="{{ $errors->has('email') ? 'error-field' : '' }}"
                        />
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tombol Kirim -->
                    <button type="submit" class="submit-btn" data-test="email-password-reset-link-button">
                        Kirim Link Reset Kata Sandi
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="back-to-login">
                    Atau, kembali ke 
                    <a href="{{ route('login') }}" wire:navigate>halaman masuk</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts::base>