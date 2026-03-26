<x-layouts::base title="Halaman Beranda" active="home">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-amber-700 via-amber-600 to-amber-800 overflow-hidden pt-16 pb-16 md:pt-0 md:pb-0 md:h-[600px]">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mb-48"></div>
        </div>

        <!-- Content -->
        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
            <div class="flex flex-col md:flex-row items-center gap-12 w-full">
                <!-- Left Content -->
                <div class="flex-1 text-white">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Masjid Syatho
                        <br>
                        <span class="text-amber-200">Sedan Rembang</span>
                    </h1>
                    <p class="text-xl text-amber-100 mb-8 max-w-xl">
                        Melayani umat dengan sepenuh hati. Tempat beribadah yang nyaman, aman, dan dilengkapi fasilitas modern.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-white text-amber-700 font-bold rounded-lg hover:bg-amber-50 transition">
                            Portal Masjid
                        </a>
                        <a href="#fasilitas" class="px-8 py-3 bg-amber-600 text-white font-bold rounded-lg hover:bg-amber-700 transition border-2 border-white">
                            Lihat Fasilitas
                        </a>
                    </div>
                </div>

                <!-- Right - Icon Illustration -->
                <div class="flex-1 text-center">
                    <img src="{{ asset('images/halaman_depan.png') }}" alt="Masjid Syatho" class="w-full max-w-md mx-auto rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Stat 1 -->
                <div class="text-center p-6 rounded-lg bg-gradient-to-br from-amber-50 to-yellow-50 border border-amber-100">
                    <div class="text-4xl font-bold text-amber-700 mb-2">2500+</div>
                    <p class="text-amber-600 font-semibold">Kapasitas Jamaah</p>
                    <p class="text-sm text-amber-500 mt-2">Ruang luas untuk beribadah bersama</p>
                </div>

                <!-- Stat 2 -->
                <div class="text-center p-6 rounded-lg bg-gradient-to-br from-amber-50 to-yellow-50 border border-amber-100">
                    <div class="text-4xl font-bold text-amber-700 mb-2">24/7</div>
                    <p class="text-amber-600 font-semibold">CCTV & Keamanan</p>
                    <p class="text-sm text-amber-500 mt-2">Pantau penuh sepanjang waktu</p>
                </div>

                <!-- Stat 3 -->
                <div class="text-center p-6 rounded-lg bg-gradient-to-br from-amber-50 to-yellow-50 border border-amber-100">
                    <div class="text-4xl font-bold text-amber-700 mb-2">12+</div>
                    <p class="text-amber-600 font-semibold">Fasilitas Lengkap</p>
                    <p class="text-sm text-amber-500 mt-2">Untuk kenyamanan jamaah dan pengunjung</p>
                </div>

                <!-- Stat 4 -->
                <div class="text-center p-6 rounded-lg bg-gradient-to-br from-amber-50 to-yellow-50 border border-amber-100">
                    <div class="text-4xl font-bold text-amber-700 mb-2">Strategis</div>
                    <p class="text-amber-600 font-semibold">Lokasi Utama</p>
                    <p class="text-sm text-amber-500 mt-2">Dekat lapangan, pasar, sekolah</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 bg-gradient-to-r from-amber-50 to-yellow-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-amber-900 mb-4">Tentang Masjid Syatho</h2>
                <p class="text-xl text-amber-700 max-w-2xl mx-auto">
                    Masjid yang didedikasikan untuk melayani umat Islam dengan fasilitas modern dan pelayanan terbaik
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Left - Icon -->
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-80 h-80 bg-gradient-to-br from-amber-400 to-amber-600 rounded-3xl flex items-center justify-center shadow-2xl">
                            <div class="text-center text-white">
                                <svg class="w-40 h-40 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                                </svg>
                                <p class="text-lg font-bold">Memberikan Pelayanan Terbaik</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right - Content -->
                <div>
                    <h3 class="text-2xl font-bold text-amber-900 mb-6">Komitmen Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex gap-4">
                            <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <div>
                                <p class="font-semibold text-amber-900">Ibadah yang Khusyu'</p>
                                <p class="text-amber-700 text-sm">Lingkungan yang tenang dan kondusif</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <div>
                                <p class="font-semibold text-amber-900">Pelayanan Profesional</p>
                                <p class="text-amber-700 text-sm">Tim yang terlatih dan berpengalaman</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <div>
                                <p class="font-semibold text-amber-900">Keamanan Terjamin</p>
                                <p class="text-amber-700 text-sm">Sistem keamanan 24 jam modern</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <div>
                                <p class="font-semibold text-amber-900">Umat Sejahtera</p>
                                <p class="text-amber-700 text-sm">Fasilitas yang memadai dan nyaman</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="fasilitas" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-amber-900 mb-4">Fasilitas Lengkap</h2>
                <p class="text-xl text-amber-700 max-w-2xl mx-auto">
                    Kami menyediakan berbagai fasilitas untuk kenyamanan dan kemudahan semua jamaah dan pengunjung
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Facility 1 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17 11h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Parkir Luas</h3>
                    <p class="text-amber-700">Tempat parkir yang luas dan aman untuk kendaraan roda dua dan roda empat</p>
                </div>

                <!-- Facility 2 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M10 15l5.07-5.07M17.17 7.71L15.9 9c-3.39-3.39-8.79-3.39-12.18 0l1.27 1.27M4.83 10.29L3.56 11.56c3.39 3.39 8.79 3.39 12.18 0l-1.27-1.27"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Free WiFi</h3>
                    <p class="text-amber-700">Internet gratis tersedia di waktu-waktu tertentu untuk kenyamanan jamaah dan pengunjung</p>
                </div>

                <!-- Facility 3 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">CCTV 24 Jam</h3>
                    <p class="text-amber-700">Sistem keamanan tersentralisasi dengan monitoring penuh sepanjang waktu untuk kenyamanan jamaah dan pengunjung</p>
                </div>

                <!-- Facility 4 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54h2.96l3.78-4.93L19.5 12h-2.96z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Kamar Mandi Terpisah</h3>
                    <p class="text-amber-700">Kamar mandi khusus laki-laki dan perempuan yang bersih dan nyaman</p>
                </div>

                <!-- Facility 5 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2zm-2 12H4V4h14v10z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Gazebo & Ruang Terbuka</h3>
                    <p class="text-amber-700">Area gazebo untuk berkumpul dan berbincang dalam kehangatan</p>
                </div>

                <!-- Facility 6 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Layanan Ambulans</h3>
                    <p class="text-amber-700">Ambulans siaga untuk memberikan respons cepat dalam keadaan darurat</p>
                </div>

                <!-- Facility 7 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Pelayanan Akad Nikah</h3>
                    <p class="text-amber-700">Layanan akad nikah profesional dengan ruang yang indah dan nyaman untuk jamaah dan pengunjung</p>
                </div>

                <!-- Facility 8 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 19l-7-7h4V4h6v8h4l-7 7z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Mesin Pompa</h3>
                    <p class="text-amber-700">Mesin pompa untuk kebutuhan air dan utilitas masjid</p>
                </div>

                <!-- Facility 9 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Kulkas</h3>
                    <p class="text-amber-700">Fasilitas kulkas untuk menyimpan minuman dan makanan jamaah dan pengunjung</p>
                </div>

                <!-- Facility 10 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1C6.48 1 2 5.48 2 11s4.48 10 10 10 10-4.48 10-10S17.52 1 12 1zm-2 15l-5-5 1.41-1.41L10 13.17l7.59-7.59L19 7l-9 9z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Satpam & Keamanan</h3>
                    <p class="text-amber-700">Tim satpam profesional untuk mengatur parkir dan menjaga ketertiban</p>
                </div>

                <!-- Facility 11 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Lokasi Strategis</h3>
                    <p class="text-amber-700">Berada dekat dengan lapangan, pasar, dan sekolah untuk kemudahan akses</p>
                </div>

                <!-- Facility 12 -->
                <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Perpustakaan</h3>
                    <p class="text-amber-700">Koleksi kitab dan buku pembelajaran Islam untuk menambah wawasan jamaah</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Prayer Times Section -->
    <section id="waktu-sholat" class="py-16 bg-gradient-to-r from-amber-50 to-yellow-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-amber-900 mb-4">Jadwal Sholat</h2>
                <p class="text-xl text-amber-700 max-w-2xl mx-auto">
                    Waktu sholat hari ini untuk wilayah Sedan, Kabupaten Rembang
                </p>
            </div>

            <div class="max-w-md mx-auto">
                <livewire:waktu-sholat />
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-amber-700 to-amber-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Jadilah Bagian dari Jamaah Kami</h2>
            <p class="text-xl text-amber-100 mb-8">
                Bergabunglah dengan ribuan jamaah yang telah merasakan kenyamanan dan kedamaian beribadah di Masjid Syatho
            </p>
            <a href="#kontak" class="inline-block px-8 py-4 bg-white text-amber-700 font-bold rounded-lg hover:bg-amber-50 transition text-lg">
                Hubungi Kami Sekarang
            </a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-amber-900 mb-4">Hubungi Kami</h2>
                <p class="text-xl text-amber-700 max-w-2xl mx-auto">
                    Kami siap membantu dan menjawab pertanyaan Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Address -->
                <div class="p-8 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 text-center">
                    <div class="w-16 h-16 bg-amber-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Alamat</h3>
                    <p class="text-amber-700">SEDAN RT 01 RW 04<br>(Belakang Masjid Syatho)<br>Karanganyar, Sedan<br>Kec. Sedan, Kabupaten Rembang<br>Jawa Tengah 59264</p>
                </div>

                <!-- Phone -->
                <div class="p-8 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-100 text-center">
                    <div class="w-16 h-16 bg-amber-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Telepon</h3>
                    <p class="text-amber-700">(024) XXX-XXXX</p>
                </div>
            </div>

            <!-- Map -->
            <div class="mt-12 rounded-xl overflow-hidden border-2 border-amber-200 h-96 bg-gray-200">
                <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.351906434!2d111.5741508!3d-6.7677443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77174f0e88ac87%3A0x3bf1a9e8d2fc8601!2sMASJID%20SYATHO%20SEDAN!5e0!3m2!1sen!2sid!4v1740878826857" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
</x-layouts::base>