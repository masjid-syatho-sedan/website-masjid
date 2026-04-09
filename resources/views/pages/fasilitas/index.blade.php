<x-layouts::base title="Fasilitas - Masjid Syatho Sedan" active="fasilitas">

    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-amber-700 via-amber-600 to-amber-800 overflow-hidden pt-16 pb-20 md:pt-24 md:pb-24">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mb-48"></div>
            <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-amber-900/40 text-amber-100 text-sm font-semibold px-4 py-2 rounded-full mb-6">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                Masjid Syatho Sedan, Rembang
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Fasilitas Lengkap
                <br>
                <span class="text-amber-200">untuk Kenyamanan Umat</span>
            </h1>
            <p class="text-lg md:text-xl text-amber-100 max-w-3xl mx-auto mb-10">
                Masjid Syatho Sedan menyediakan berbagai fasilitas modern dan lengkap yang dirancang untuk memberikan kenyamanan maksimal bagi seluruh jamaah dan pengunjung.
            </p>

            {{-- Stats Bar --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <div class="bg-white/20 backdrop-blur rounded-xl p-4 text-white">
                    <div class="text-3xl font-bold">12+</div>
                    <div class="text-amber-200 text-sm font-medium mt-1">Fasilitas Tersedia</div>
                </div>
                <div class="bg-white/20 backdrop-blur rounded-xl p-4 text-white">
                    <div class="text-3xl font-bold">2500+</div>
                    <div class="text-amber-200 text-sm font-medium mt-1">Kapasitas Jamaah</div>
                </div>
                <div class="bg-white/20 backdrop-blur rounded-xl p-4 text-white">
                    <div class="text-3xl font-bold">24/7</div>
                    <div class="text-amber-200 text-sm font-medium mt-1">Keamanan Aktif</div>
                </div>
                <div class="bg-white/20 backdrop-blur rounded-xl p-4 text-white">
                    <div class="text-3xl font-bold">Gratis</div>
                    <div class="text-amber-200 text-sm font-medium mt-1">Akses untuk Umum</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Category Navigation --}}
    <section class="bg-white border-b border-amber-100 sticky top-16 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-1 overflow-x-auto py-3 scrollbar-none">
                <a href="#ibadah" data-nav="ibadah" class="nav-link flex-shrink-0 px-4 py-2 rounded-lg text-amber-700 text-sm font-semibold hover:bg-amber-50 transition">
                    Ibadah & Utama
                </a>
                <a href="#keamanan" data-nav="keamanan" class="nav-link flex-shrink-0 px-4 py-2 rounded-lg text-amber-700 text-sm font-semibold hover:bg-amber-50 transition">
                    Keamanan
                </a>
                <a href="#sanitasi" data-nav="sanitasi" class="nav-link flex-shrink-0 px-4 py-2 rounded-lg text-amber-700 text-sm font-semibold hover:bg-amber-50 transition">
                    Sanitasi & Air
                </a>
                <a href="#sosial" data-nav="sosial" class="nav-link flex-shrink-0 px-4 py-2 rounded-lg text-amber-700 text-sm font-semibold hover:bg-amber-50 transition">
                    Sosial & Layanan
                </a>
                <a href="#pendidikan" data-nav="pendidikan" class="nav-link flex-shrink-0 px-4 py-2 rounded-lg text-amber-700 text-sm font-semibold hover:bg-amber-50 transition">
                    Pendidikan
                </a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sections = ['ibadah', 'keamanan', 'sanitasi', 'sosial', 'pendidikan'];

            function setActive(id) {
                document.querySelectorAll('.nav-link').forEach(link => {
                    const isActive = link.dataset.nav === id;
                    link.classList.toggle('bg-amber-600', isActive);
                    link.classList.toggle('text-white', isActive);
                    link.classList.toggle('text-amber-700', !isActive);
                });
            }

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setActive(entry.target.id);

                        // scroll nav link into view jika di mobile
                        const activeLink = document.querySelector(`.nav-link[data-nav="${entry.target.id}"]`);
                        if (activeLink) activeLink.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    }
                });
            }, {
                rootMargin: '-30% 0px -60% 0px',
                threshold: 0
            });

            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) observer.observe(el);
            });
        });
    </script>

    {{-- ======================================================== --}}
    {{-- KATEGORI 1: Ibadah & Fasilitas Utama --}}
    {{-- ======================================================== --}}
    <section id="ibadah" class="py-20 bg-gradient-to-br from-amber-50 to-yellow-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-amber-900">Ibadah & Fasilitas Utama</h2>
                    <p class="text-amber-600 mt-1">Fasilitas inti untuk mendukung kegiatan ibadah yang khusyu' dan nyaman</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Ruang Sholat Utama --}}
                <div class="bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden hover:shadow-md transition group">
                    <div class="bg-gradient-to-r from-amber-600 to-amber-500 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                                <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Ruang Sholat Utama</h3>
                                <p class="text-amber-200 text-sm">Kapasitas 2500+ Jamaah</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-amber-800 mb-4">Ruang sholat yang luas, bersih, dan nyaman dengan sirkulasi udara yang baik. Dilengkapi karpet berkualitas, sound system yang jernih, dan pencahayaan yang memadai.</p>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Karpet premium
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Sound system
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                AC & kipas
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Shaf teratur
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Area Parkir Luas --}}
                <div class="bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden hover:shadow-md transition group">
                    <div class="bg-gradient-to-r from-amber-600 to-amber-500 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                                <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Area Parkir Luas</h3>
                                <p class="text-amber-200 text-sm">Roda 2 & Roda 4</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-amber-800 mb-4">Tersedia area parkir yang luas dan terorganisir untuk kendaraan roda dua maupun roda empat. Dikelola oleh petugas satpam yang terlatih untuk menjaga ketertiban dan keamanan kendaraan jamaah.</p>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Area motor
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Area mobil
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Dijaga satpam
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Gratis
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gazebo & Ruang Terbuka --}}
                <div class="bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden hover:shadow-md transition group">
                    <div class="bg-gradient-to-r from-green-600 to-green-500 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                                <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Gazebo & Ruang Terbuka</h3>
                                <p class="text-green-200 text-sm">Area berkumpul yang nyaman</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-amber-800 mb-4">Area gazebo dan ruang terbuka hijau yang asri menjadi tempat nyaman untuk bersantai, berdiskusi, dan berkumpul bersama setelah sholat berjamaah. Suasana sejuk dan teduh menambah kenyamanan.</p>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Area teduh
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Bangku tersedia
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Taman hijau
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Bebas digunakan
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Free WiFi --}}
                <div class="bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden hover:shadow-md transition group">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                                <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M1 9l2 2c4.97-4.97 13.03-4.97 18 0l2-2C16.93 2.93 7.08 2.93 1 9zm8 8l3 3 3-3c-1.65-1.66-4.34-1.66-6 0zm-4-4l2 2c2.76-2.76 7.24-2.76 10 0l2-2C15.14 9.14 8.87 9.14 5 13z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Free WiFi</h3>
                                <p class="text-blue-200 text-sm">Internet gratis untuk jamaah</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-amber-800 mb-4">Jaringan WiFi gratis tersedia di area masjid pada waktu-waktu tertentu untuk memudahkan jamaah mengakses informasi keislaman, membaca Al-Qur'an digital, dan kebutuhan komunikasi lainnya.</p>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Tanpa biaya
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Area masjid
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Koneksi stabil
                            </div>
                            <div class="flex items-center gap-2 text-sm text-amber-700">
                                <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                Multi-device
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ======================================================== --}}
    {{-- KATEGORI 2: Keamanan --}}
    {{-- ======================================================== --}}
    <section id="keamanan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-slate-700 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-amber-900">Keamanan Terjamin</h2>
                    <p class="text-amber-600 mt-1">Sistem keamanan berlapis untuk kenyamanan dan ketenangan jamaah</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- CCTV 24 Jam --}}
                <div class="rounded-2xl border-2 border-slate-100 overflow-hidden hover:shadow-lg transition">
                    <div class="bg-slate-800 p-6 text-center">
                        <div class="w-16 h-16 bg-slate-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">CCTV 24 Jam</h3>
                        <p class="text-slate-400 text-sm mt-1">Monitoring penuh</p>
                    </div>
                    <div class="p-5 bg-slate-50">
                        <p class="text-amber-800 text-sm mb-4">Sistem CCTV tersentralisasi memantau seluruh area masjid, parkiran, dan sekitarnya selama 24 jam penuh tanpa henti. Rekaman tersimpan aman untuk kebutuhan investigasi jika diperlukan.</p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Kamera resolusi tinggi
                            </li>
                            <li class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Titik strategis & parkir
                            </li>
                            <li class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Dipantau petugas
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Satpam & Keamanan --}}
                <div class="rounded-2xl border-2 border-slate-100 overflow-hidden hover:shadow-lg transition">
                    <div class="bg-slate-800 p-6 text-center">
                        <div class="w-16 h-16 bg-slate-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-1 14l-3-3 1.41-1.41L11 12.17l4.59-4.58L17 9l-6 6z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">Satpam Profesional</h3>
                        <p class="text-slate-400 text-sm mt-1">Petugas terlatih</p>
                    </div>
                    <div class="p-5 bg-slate-50">
                        <p class="text-amber-800 text-sm mb-4">Tim satpam profesional bertugas menjaga ketertiban, mengatur parkir, dan memastikan keamanan seluruh area masjid. Petugas selalu siap membantu kebutuhan jamaah dan pengunjung.</p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Mengatur parkir
                            </li>
                            <li class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Jaga ketertiban
                            </li>
                            <li class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Siap membantu
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Lokasi Strategis --}}
                <div class="rounded-2xl border-2 border-slate-100 overflow-hidden hover:shadow-lg transition">
                    <div class="bg-slate-800 p-6 text-center">
                        <div class="w-16 h-16 bg-slate-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">Lokasi Strategis</h3>
                        <p class="text-slate-400 text-sm mt-1">Mudah dijangkau</p>
                    </div>
                    <div class="p-5 bg-slate-50">
                        <p class="text-amber-800 text-sm mb-4">Berlokasi di posisi yang sangat strategis di pusat Sedan, dekat lapangan, pasar tradisional, dan sekolah. Mudah diakses oleh warga dari berbagai penjuru kecamatan Sedan.</p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Dekat lapangan
                            </li>
                            <li class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Dekat pasar
                            </li>
                            <li class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Akses mudah
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ======================================================== --}}
    {{-- KATEGORI 3: Sanitasi & Air --}}
    {{-- ======================================================== --}}
    <section id="sanitasi" class="py-20 bg-gradient-to-br from-cyan-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-cyan-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2c-5.33 4.55-8 8.48-8 11.8 0 4.98 3.8 8.2 8 8.2s8-3.22 8-8.2c0-3.32-2.67-7.25-8-11.8zm0 18c-3.35 0-6-2.57-6-6.2 0-2.34 1.95-5.44 6-9.14 4.05 3.7 6 6.79 6 9.14 0 3.63-2.65 6.2-6 6.2zm-4-8c.61 2.03 2.21 3.59 4 4-.61-2.03-2.21-3.59-4-4z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-amber-900">Sanitasi & Air Bersih</h2>
                    <p class="text-amber-600 mt-1">Fasilitas kebersihan dan air yang terjaga higienitasnya</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Kamar Mandi Terpisah --}}
                <div class="bg-white rounded-2xl shadow-sm border border-cyan-100 p-8 hover:shadow-md transition">
                    <div class="flex items-start gap-5">
                        <div class="w-14 h-14 bg-cyan-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 2v11h3v9l7-12h-4l4-8z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-amber-900 mb-2">Kamar Mandi Terpisah</h3>
                            <p class="text-amber-700 mb-5">Tersedia kamar mandi dan toilet yang bersih, terpisah antara laki-laki dan perempuan. Dibersihkan secara rutin setiap hari oleh petugas kebersihan untuk menjaga higienitas.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-cyan-100 text-cyan-700 rounded-full text-xs font-semibold">Khusus Pria</span>
                                <span class="px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">Khusus Wanita</span>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Dibersihkan Rutin</span>
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-semibold">Air Mengalir</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tempat Wudhu --}}
                <div class="bg-white rounded-2xl shadow-sm border border-cyan-100 p-8 hover:shadow-md transition">
                    <div class="flex items-start gap-5">
                        <div class="w-14 h-14 bg-cyan-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2c-5.33 4.55-8 8.48-8 11.8 0 4.98 3.8 8.2 8 8.2s8-3.22 8-8.2c0-3.32-2.67-7.25-8-11.8zm0 18c-3.35 0-6-2.57-6-6.2 0-2.34 1.95-5.44 6-9.14 4.05 3.7 6 6.79 6 9.14 0 3.63-2.65 6.2-6 6.2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-amber-900 mb-2">Tempat Wudhu</h3>
                            <p class="text-amber-700 mb-5">Tempat wudhu yang luas dengan banyak kran air bersih, terpisah antara jamaah pria dan wanita. Dilengkapi pencahayaan yang baik dan lantai anti-licin untuk keamanan jamaah.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-cyan-100 text-cyan-700 rounded-full text-xs font-semibold">Terpisah</span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Banyak Kran</span>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Anti-licin</span>
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-semibold">Air bersih</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mesin Pompa Air --}}
                <div class="bg-white rounded-2xl shadow-sm border border-cyan-100 p-8 hover:shadow-md transition">
                    <div class="flex items-start gap-5">
                        <div class="w-14 h-14 bg-cyan-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 19l-7-7h4V4h6v8h4l-7 7z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-amber-900 mb-2">Mesin Pompa Air</h3>
                            <p class="text-amber-700 mb-5">Mesin pompa air berkapasitas besar memastikan pasokan air bersih yang cukup untuk seluruh kebutuhan masjid, mulai dari wudhu, toilet, hingga kegiatan kebersihan lingkungan masjid.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-cyan-100 text-cyan-700 rounded-full text-xs font-semibold">Kapasitas besar</span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Siap pakai</span>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Air terjaga</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kulkas --}}
                <div class="bg-white rounded-2xl shadow-sm border border-cyan-100 p-8 hover:shadow-md transition">
                    <div class="flex items-start gap-5">
                        <div class="w-14 h-14 bg-cyan-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11 15h2v2h-2v-2zm0-8h2v6h-2V7zm1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-amber-900 mb-2">Fasilitas Kulkas</h3>
                            <p class="text-amber-700 mb-5">Tersedia kulkas untuk menyimpan minuman segar dan makanan yang dapat digunakan oleh jamaah, pengunjung, dan petugas masjid. Terutama bermanfaat saat ada kegiatan pengajian dan pertemuan.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-cyan-100 text-cyan-700 rounded-full text-xs font-semibold">Minuman segar</span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Bebas digunakan</span>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Kapasitas besar</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ======================================================== --}}
    {{-- KATEGORI 4: Sosial & Layanan --}}
    {{-- ======================================================== --}}
    <section id="sosial" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-rose-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-amber-900">Layanan Sosial Kemasyarakatan</h2>
                    <p class="text-amber-600 mt-1">Masjid sebagai pusat pelayanan umat yang menyeluruh</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Layanan Ambulans --}}
                <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-2xl border-2 border-red-100 overflow-hidden hover:shadow-lg transition">
                    <div class="p-8">
                        <div class="flex items-start gap-5">
                            <div class="w-16 h-16 bg-red-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 8h-3V6c0-1.1-.9-2-2-2H9C7.9 4 7 4.9 7 6v2H4c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-9c0-1.1-.9-2-2-2zm-5 9h-2v-2h-2v2H9v-2H7v-2h2v-2h2v2h2v-2h2v2h2v2h-2v2zm0-11H9V6h6v2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="inline-flex items-center gap-1 bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded-full mb-2">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
                                    SIAGA 24 JAM
                                </div>
                                <h3 class="text-xl font-bold text-amber-900 mb-2">Layanan Ambulans Gratis</h3>
                                <p class="text-amber-700 mb-4">Ambulans siap melayani warga yang membutuhkan pertolongan medis darurat secara gratis. Cepat tanggap dan siap bergerak kapan pun dibutuhkan oleh masyarakat sekitar.</p>
                                <a wire:navigate href="/fasilitas/ambulans" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white rounded-lg font-semibold text-sm hover:bg-red-700 transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 pb-6 grid grid-cols-3 gap-3">
                        <div class="bg-white rounded-xl p-3 text-center border border-red-100">
                            <div class="text-xl font-bold text-red-600">24/7</div>
                            <div class="text-xs text-amber-600 font-medium">Siaga</div>
                        </div>
                        <div class="bg-white rounded-xl p-3 text-center border border-red-100">
                            <div class="text-xl font-bold text-red-600">Gratis</div>
                            <div class="text-xs text-amber-600 font-medium">Biaya</div>
                        </div>
                        <div class="bg-white rounded-xl p-3 text-center border border-red-100">
                            <div class="text-xl font-bold text-red-600">Cepat</div>
                            <div class="text-xs text-amber-600 font-medium">Respons</div>
                        </div>
                    </div>
                </div>

                {{-- Pelayanan Akad Nikah --}}
                <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl border-2 border-pink-100 overflow-hidden hover:shadow-lg transition">
                    <div class="p-8">
                        <div class="flex items-start gap-5">
                            <div class="w-16 h-16 bg-pink-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="inline-flex items-center gap-1 bg-pink-100 text-pink-700 text-xs font-bold px-2 py-1 rounded-full mb-2">
                                    TERSEDIA
                                </div>
                                <h3 class="text-xl font-bold text-amber-900 mb-2">Pelayanan Akad Nikah</h3>
                                <p class="text-amber-700 mb-5">Layanan akad nikah dengan ruang yang nyaman dan indah. Masjid Syatho menjadi tempat sakral untuk momen bersejarah dalam kehidupan umat Islam Sedan dan sekitarnya.</p>
                            </div>
                        </div>
                        <div class="mt-2 space-y-2">
                            <div class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 border border-pink-100">
                                <svg class="w-5 h-5 text-pink-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span class="text-sm text-amber-800">Ruang nyaman & representatif</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 border border-pink-100">
                                <svg class="w-5 h-5 text-pink-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span class="text-sm text-amber-800">Penghulu & administrasi terbantu</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 border border-pink-100">
                                <svg class="w-5 h-5 text-pink-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span class="text-sm text-amber-800">Kapasitas tamu yang memadai</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ======================================================== --}}
    {{-- KATEGORI 5: Pendidikan --}}
    {{-- ======================================================== --}}
    <section id="pendidikan" class="py-20 bg-gradient-to-br from-amber-50 to-yellow-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-amber-700 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3L1 9l4 2.18V15h2v-2.82l2 1.09V17c0 1.1 2.24 2 5 2s5-.9 5-2v-3.73L23 9 12 3zm4.54 8.54L12 14.5l-4.54-2.96-.46-.26V9.09L12 12l5-2.91v2.19l-.46.26z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-amber-900">Pendidikan & Wawasan Islam</h2>
                    <p class="text-amber-600 mt-1">Fasilitas untuk meningkatkan ilmu dan wawasan keislaman jamaah</p>
                </div>
            </div>

            {{-- Perpustakaan - Featured Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-amber-100 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-10">
                        <div class="w-16 h-16 bg-amber-700 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zm0 13.5c-1.1-.35-2.3-.5-3.5-.5-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5 1.2 0 2.4.15 3.5.5v11.5z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-amber-900 mb-3">Perpustakaan Islam</h3>
                        <p class="text-amber-700 mb-6">Koleksi kitab kuning, buku-buku keislaman, Al-Qur'an, tafsir, dan berbagai referensi Islam tersedia untuk dibaca oleh jamaah. Perpustakaan ini menjadi sumber ilmu bagi masyarakat Sedan dan sekitarnya.</p>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                <span class="text-amber-800">Koleksi kitab kuning & tafsir Al-Qur'an</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                <span class="text-amber-800">Buku fiqih, aqidah, dan sejarah Islam</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                <span class="text-amber-800">Tersedia untuk umum, gratis dibaca</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                <span class="text-amber-800">Koleksi terus diperbarui</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-amber-700 to-amber-800 p-10 flex flex-col justify-center items-center text-center">
                        <svg class="w-28 h-28 text-amber-200 mb-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zm0 13.5c-1.1-.35-2.3-.5-3.5-.5-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5 1.2 0 2.4.15 3.5.5v11.5z"/>
                        </svg>
                        <p class="text-3xl font-bold text-white mb-2">100+</p>
                        <p class="text-amber-200 font-semibold mb-1">Koleksi Buku & Kitab</p>
                        <p class="text-amber-300 text-sm">Sumber ilmu yang terus bertambah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-r from-amber-700 to-amber-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Kunjungi Masjid Syatho Sedan</h2>
            <p class="text-xl text-amber-100 mb-8 max-w-2xl mx-auto">
                Rasakan sendiri kenyamanan beribadah dan nikmati berbagai fasilitas yang kami sediakan untuk seluruh jamaah dan pengunjung.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://maps.google.com/?q=MASJID+SYATHO+SEDAN" target="_blank" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-amber-700 font-bold rounded-xl hover:bg-amber-50 transition text-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    Lihat di Maps
                </a>
                <a wire:navigate href="/" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-amber-600 border-2 border-amber-400 text-white font-bold rounded-xl hover:bg-amber-600 transition text-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    Ke Halaman Utama
                </a>
            </div>

            {{-- Address --}}
            <div class="mt-10 inline-flex items-center gap-3 bg-amber-900/40 text-amber-200 px-6 py-3 rounded-xl text-sm">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                SEDAN RT 01 RW 04, Karanganyar, Sedan, Kec. Sedan, Kabupaten Rembang, Jawa Tengah 59264
            </div>
        </div>
    </section>

</x-layouts::base>
