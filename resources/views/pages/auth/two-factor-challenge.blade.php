<x-layouts::base :title="'Autentikasi Dua Faktor'" active="portal">
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

        .submit-btn {
            background: linear-gradient(135deg, var(--warna-utama) 0%, var(--warna-utama-gelap) 100%);
            color: white;
            padding: 1rem 1.5rem;
            border: none; border-radius: 10px;
            font-size: 0.95rem; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(30,126,52,0.2);
            width: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(30,126,52,0.3);
        }

        .submit-btn:active { transform: translateY(0); }

        .recovery-input {
            padding: 0.95rem 1rem;
            border: 1.5px solid var(--warna-border);
            border-radius: 10px;
            font-size: 0.95rem; color: var(--teks-utama);
            transition: all 0.3s ease;
            background: #f9fafb;
            width: 100%;
            box-sizing: border-box;
        }

        .recovery-input:focus {
            outline: none;
            border-color: var(--warna-utama);
            background: var(--warna-background);
            box-shadow: 0 0 0 3px rgba(30,126,52,0.1);
        }

        .toggle-link {
            display: inline;
            color: var(--warna-utama);
            font-weight: 600;
            cursor: pointer;
            text-decoration: underline;
            font-size: 0.875rem;
            background: none;
            border: none;
            padding: 0;
        }

        .toggle-link:hover { color: var(--warna-utama-gelap); }

        .toggle-row {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.875rem;
            color: var(--teks-ringan);
        }

        .error-text { color: #dc2626; font-size: 0.8rem; margin-top: 0.5rem; text-align: center; }

        @media (max-width: 640px) {
            .auth-wrapper { padding: 1rem; }
            .auth-card { padding: 2rem 1.5rem; border-radius: 16px; }
            .auth-header h1 { font-size: 1.5rem; }
        }
    </style>

    <div class="auth-container">
        <div class="auth-wrapper">
            <div class="auth-card"
                x-cloak
                x-data="{
                    showRecoveryInput: @js($errors->has('recovery_code')),
                    code: '',
                    recovery_code: '',
                    toggleInput() {
                        this.showRecoveryInput = !this.showRecoveryInput;
                        this.code = '';
                        this.recovery_code = '';
                        $dispatch('clear-2fa-auth-code');
                        $nextTick(() => {
                            this.showRecoveryInput
                                ? this.$refs.recovery_code?.focus()
                                : $dispatch('focus-2fa-auth-code');
                        });
                    },
                }"
            >
                <div class="auth-header">
                    <div class="logo-icon">🔒</div>
                    <div x-show="!showRecoveryInput">
                        <h1>Kode Autentikasi</h1>
                        <p>Masukkan kode dari aplikasi autentikator Anda</p>
                    </div>
                    <div x-show="showRecoveryInput">
                        <h1>Kode Pemulihan</h1>
                        <p>Masukkan salah satu kode pemulihan darurat Anda</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('two-factor.login.store') }}">
                    @csrf

                    <div style="text-align:center;">
                        <div x-show="!showRecoveryInput" style="margin-bottom:1.5rem;">
                            <div style="display:flex;justify-content:center;margin-bottom:1.5rem;">
                                <flux:otp
                                    x-model="code"
                                    length="6"
                                    name="code"
                                    label="OTP Code"
                                    label:sr-only
                                />
                            </div>
                        </div>

                        <div x-show="showRecoveryInput" style="margin-bottom:1.5rem;">
                            <input
                                type="text"
                                name="recovery_code"
                                x-ref="recovery_code"
                                x-bind:required="showRecoveryInput"
                                autocomplete="one-time-code"
                                x-model="recovery_code"
                                placeholder="Kode pemulihan"
                                class="recovery-input"
                            />
                            @error('recovery_code')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="submit-btn">
                            Lanjutkan
                        </button>
                    </div>

                    <div class="toggle-row">
                        <span class="opacity-60">atau </span>
                        <span x-show="!showRecoveryInput">
                            <button type="button" class="toggle-link" @click="toggleInput()">gunakan kode pemulihan</button>
                        </span>
                        <span x-show="showRecoveryInput">
                            <button type="button" class="toggle-link" @click="toggleInput()">gunakan kode autentikator</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::base>
