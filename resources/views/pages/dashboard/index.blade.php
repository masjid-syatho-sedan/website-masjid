<x-layouts::portal :title="__('Dashboard')">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap');

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .animate-blink {
            animation: blink 1.8s ease-in-out infinite
        }

        .animate-fadeUp {
            animation: fadeUp .4s ease both
        }
    </style>


    <div class="font-['Plus_Jakarta_Sans'] max-w-[1200px]">

        {{-- HERO --}}
        <div
            class="relative rounded-3xl overflow-hidden mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-5
 bg-gradient-to-br from-amber-900 via-amber-800 to-amber-500
px-6 py-7 md:px-11 md:py-10 shadow-[0_8px_40px_rgba(120,53,15,0.3)]">

            <div class="absolute -top-[60px] -right-[60px] w-[220px] h-[220px] rounded-full bg-white/5"></div>
            <div class="absolute -bottom-[40px] left-[30%] w-[160px] h-[160px] rounded-full bg-white/5"></div>

            <div
                class="absolute top-4 right-[180px] opacity-[0.07] text-[120px] text-white pointer-events-none select-none font-['Playfair_Display']">
                ☽
            </div>

            <div class="relative z-10">

                <p class="text-[0.78rem] font-semibold tracking-widest uppercase text-amber-200/70 mb-1">
                    Selamat Datang, {{ auth()->user()->name }}
                </p>

                <h1 class="font-['Playfair_Display'] text-2xl md:text-3xl font-bold text-white leading-tight mb-2">
                    Masjid Syatho<br>
                    <span class="text-amber-200">Sedan Rembang</span>
                </h1>

                <p class="text-amber-100/70 text-sm max-w-full md:max-w-[380px] leading-relaxed">
                    Portal manajemen resmi Masjid Syatho. Pantau fasilitas, kegiatan, dan informasi masjid secara
                    terpusat.
                </p>

            </div>

            <div class="relative z-10 flex flex-row flex-wrap md:flex-col md:items-end gap-2">

                <div
                    class="flex items-center gap-2 px-4 py-1 rounded-full border border-white/20 bg-white/10 backdrop-blur text-amber-100 text-sm font-semibold">
                    <span class="w-[7px] h-[7px] bg-green-400 rounded-full animate-blink"></span>
                    Sistem Aktif
                </div>

                <div class="px-4 py-1 rounded-full bg-white/10 text-amber-100 text-sm font-semibold">
                    📍 Sedan, Kab. Rembang
                </div>

            </div>
        </div>


        {{-- STATS --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

            <div
                class="flex items-center gap-4 bg-white border border-amber-200 rounded-2xl p-5 shadow-sm hover:-translate-y-1 hover:shadow-lg transition animate-fadeUp">

                <div
                    class="w-11 h-11 rounded-xl flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                </div>

                <div>
                    <div class="font-['Playfair_Display'] text-2xl font-bold text-amber-900">2500+</div>
                    <div class="text-xs text-amber-700 font-medium">Kapasitas Jamaah</div>
                </div>

            </div>


            <div
                class="flex items-center gap-4 bg-white border border-amber-200 rounded-2xl p-5 shadow-sm hover:-translate-y-1 hover:shadow-lg transition animate-fadeUp">

                <div
                    class="w-11 h-11 rounded-xl flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="4" y="4" width="16" height="16" />
                    </svg>
                </div>

                <div>
                    <div class="font-['Playfair_Display'] text-2xl font-bold text-amber-900">24/7</div>
                    <div class="text-xs text-amber-700 font-medium">CCTV & Keamanan</div>
                </div>

            </div>


            <div
                class="flex items-center gap-4 bg-white border border-amber-200 rounded-2xl p-5 shadow-sm hover:-translate-y-1 hover:shadow-lg transition animate-fadeUp">

                <div
                    class="w-11 h-11 rounded-xl flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16v16H4z" />
                    </svg>
                </div>

                <div>
                    <div class="font-['Playfair_Display'] text-2xl font-bold text-amber-900">12+</div>
                    <div class="text-xs text-amber-700 font-medium">Fasilitas Lengkap</div>
                </div>

            </div>


            <div
                class="flex items-center gap-4 bg-white border border-amber-200 rounded-2xl p-5 shadow-sm hover:-translate-y-1 hover:shadow-lg transition animate-fadeUp">

                <div
                    class="w-11 h-11 rounded-xl flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="6" />
                    </svg>
                </div>

                <div>
                    <div class="font-['Playfair_Display'] text-xl font-bold text-amber-900">Strategis</div>
                    <div class="text-xs text-amber-700 font-medium">Lokasi Utama</div>
                </div>

            </div>

        </div>



        {{-- SECTION HEADER --}}
        <div class="flex items-center gap-3 mb-4">

            <h2 class="font-['Playfair_Display'] text-xl font-bold text-amber-900">
                Fasilitas Masjid
            </h2>

            <div class="flex-1 h-[1px] bg-gradient-to-r from-amber-200 to-transparent"></div>

            <div class="text-xs font-bold text-amber-700 bg-amber-100 border border-amber-200 px-3 py-1 rounded-full">
                12 Fasilitas
            </div>

        </div>



        {{-- FACILITIES --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8">

            <div
                class="flex gap-4 p-4 bg-white border border-amber-100 rounded-xl hover:border-amber-400 hover:shadow-lg hover:-translate-y-1 transition animate-fadeUp">

                <div
                    class="w-10 h-10 rounded-lg flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700">
                    🚗
                </div>

                <div>
                    <div class="text-sm font-bold text-amber-900">Parkir Luas</div>
                    <div class="text-xs text-amber-700">Tempat parkir luas dan aman</div>
                </div>

            </div>


            <div
                class="flex gap-4 p-4 bg-white border border-amber-100 rounded-xl hover:border-amber-400 hover:shadow-lg hover:-translate-y-1 transition animate-fadeUp">

                <div
                    class="w-10 h-10 rounded-lg flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700">
                    📶
                </div>

                <div>
                    <div class="text-sm font-bold text-amber-900">Free WiFi</div>
                    <div class="text-xs text-amber-700">Internet gratis untuk jamaah</div>
                </div>

            </div>


            <div
                class="flex gap-4 p-4 bg-white border border-amber-100 rounded-xl hover:border-amber-400 hover:shadow-lg hover:-translate-y-1 transition animate-fadeUp">

                <div
                    class="w-10 h-10 rounded-lg flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700">
                    📷
                </div>

                <div>
                    <div class="text-sm font-bold text-amber-900">CCTV 24 Jam</div>
                    <div class="text-xs text-amber-700">Sistem keamanan aktif</div>
                </div>

            </div>

        </div>



        {{-- INFO --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

            <div class="bg-white border border-amber-200 rounded-2xl p-6 shadow-sm">

                <div class="font-['Playfair_Display'] text-sm font-bold text-amber-900 mb-4">
                    Jadwal Sholat Hari Ini
                </div>

                <div class="space-y-2">

                    <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-amber-50">
                        <span class="text-sm font-semibold text-amber-800">Subuh</span>
                        <span class="font-['Playfair_Display'] font-bold text-amber-600">04:22</span>
                    </div>

                    <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-amber-50">
                        <span class="text-sm font-semibold text-amber-800">Dzuhur</span>
                        <span class="font-['Playfair_Display'] font-bold text-amber-600">11:52</span>
                    </div>

                    <div
                        class="flex items-center justify-between px-3 py-2 rounded-lg bg-amber-100 border border-amber-300">
                        <span class="text-sm font-semibold text-amber-900">Ashar</span>
                        <span class="font-['Playfair_Display'] font-bold text-amber-700">15:10</span>
                    </div>

                </div>

            </div>



            <div class="bg-white border border-amber-200 rounded-2xl p-6 shadow-sm">

                <div class="font-['Playfair_Display'] text-sm font-bold text-amber-900 mb-4">
                    Informasi Masjid
                </div>

                <div class="space-y-3 text-sm text-amber-800">

                    <div>
                        <div class="text-xs text-amber-600">Alamat</div>
                        <div class="font-semibold">
                            Sedan RT 01 RW 04, Karanganyar<br>
                            Kec. Sedan, Kab. Rembang
                        </div>
                    </div>

                    <div>
                        <div class="text-xs text-amber-600">Telepon</div>
                        <div class="font-semibold">(024) XXX-XXXX</div>
                    </div>

                    <div>
                        <div class="text-xs text-amber-600">Keamanan</div>
                        <div class="font-semibold">CCTV 24 jam · Satpam</div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layouts::portal>
