<x-layouts::base :title="'Verifikasi Email'" active="portal">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --warna-utama: #1e7e34;
            --warna-utama-gelap: #165c2d;
            --warna-background: #ffffff;
            --warna-border: #e5e7eb;
            --teks-utama: #1f2937;
            --teks-ringan: #6b7280;
        }

        * { font-family: 'Poppins', sans-serif; }
        body { margin: 0; padding: 0; }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            position: relative;
            overflow: hidden;
        }

        .auth-container::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(30,126,52,0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px; right: -100px;
            pointer-events: none;
        }

        .auth-container::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(245,158,11,0.08) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -50px; left: -50px;
            pointer-events: none;
        }

        .auth-wrapper {
            position: relative; z-index: 10;
            width: 100%; max-width: 450px;
            padding: 2rem;
        }

        .auth-card {
            background: var(--warna-background);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(30,126,52,0.08);
            border: 1px solid rgba(30,126,52,0.1);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .logo-icon {
            width: 60px; height: 60px;
            background: linear-gradient(135deg, var(--warna-utama) 0%, var(--warna-utama-gelap) 100%);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
            font-size: 30px;
        }

        .auth-header h1 {
            font-size: 1.75rem; font-weight: 700;
            color: var(--teks-utama);
            margin: 0 0 0.5rem 0;
        }

        .auth-header p {
            color: var(--teks-ringan);
            font-size: 0.9rem; line-height: 1.6;
            margin: 0;
        }

        .info-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 1.5px solid #fcd34d;
            border-radius: 10px; padding: 1rem;
            margin-bottom: 1.5rem;
            color: #92400e; font-size: 0.875rem; line-height: 1.6;
        }

        .status-message {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border: 1.5px solid #6ee7b7;
            border-radius: 10px; padding: 1rem;
            margin-bottom: 1.5rem;
            color: #059669; font-size: 0.875rem;
        }

        .action-group {
            display: flex; flex-direction: column; gap: 0.75rem;
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--warna-utama) 0%, var(--warna-utama-gelap) 100%);
            color: white;
            padding: 1rem 1.5rem;
            border: none; border-radius: 10px;
            font-size: 0.95rem; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(30,126,52,0.2);
            text-align: center;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(30,126,52,0.3);
        }

        .logout-btn {
            background: transparent;
            color: var(--teks-ringan);
            padding: 0.75rem 1.5rem;
            border: 1.5px solid var(--warna-border);
            border-radius: 10px;
            font-size: 0.875rem; font-weight: 500;
            cursor: pointer; transition: all 0.3s ease;
            text-align: center;
        }

        .logout-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: var(--teks-utama);
        }

        @media (max-width: 640px) {
            .auth-wrapper { padding: 1rem; }
            .auth-card { padding: 2rem 1.5rem; border-radius: 16px; }
            .auth-header h1 { font-size: 1.5rem; }
        }
    </style>

    <div class="auth-container">
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="logo-icon">📧</div>
                    <h1>Verifikasi Email</h1>
                    <p>Silakan verifikasi alamat email Anda sebelum melanjutkan</p>
                </div>

                <div class="info-box">
                    💡 Kami telah mengirimkan link verifikasi ke email Anda. Klik link tersebut untuk mengaktifkan akun.
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="status-message">
                        ✓ Link verifikasi baru telah dikirim ke email yang Anda daftarkan.
                    </div>
                @endif

                <div class="action-group">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="submit-btn" style="width:100%;">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn" style="width:100%;" data-test="logout-button">
                            Keluar dari Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts::base>
