<x-layouts::base :title="'Blog & Artikel'" :active="'artikel'">
    <style>
        :root {
            --warna-utama: #b45309;
            --warna-utama-gelap: #92400e;
            --warna-hijau: #1e7e34;
            --warna-background: #ffffff;
            --warna-border: #f3e8ff;
            --teks-utama: #1f2937;
            --teks-ringan: #6b7280;
        }

        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-amber-700 via-amber-600 to-amber-800 overflow-hidden py-20">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mb-48"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Blog & Artikel
            </h1>
            <p class="text-xl text-amber-100 max-w-2xl mx-auto">
                Baca artikel inspiratif, tips ibadah, dan berita terkini dari Masjid Syatho
            </p>
        </div>
    </section>

    <!-- Search & Filter Section -->
    <section class="py-12 bg-white border-b border-amber-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Search Bar -->
                <div class="flex-1">
                    <input 
                        type="text" 
                        placeholder="Cari artikel..." 
                        class="w-full px-6 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-700 focus:outline-none transition"
                    >
                </div>

                <!-- Category Filter -->
                <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0">
                    <button class="px-6 py-3 rounded-lg bg-amber-700 text-white font-semibold whitespace-nowrap hover:bg-amber-800 transition">
                        Semua
                    </button>
                    <button class="px-6 py-3 rounded-lg bg-amber-50 text-amber-700 font-semibold whitespace-nowrap hover:bg-amber-100 transition border-2 border-amber-200">
                        Ibadah
                    </button>
                    <button class="px-6 py-3 rounded-lg bg-amber-50 text-amber-700 font-semibold whitespace-nowrap hover:bg-amber-100 transition border-2 border-amber-200">
                        Tips & Trik
                    </button>
                    <button class="px-6 py-3 rounded-lg bg-amber-50 text-amber-700 font-semibold whitespace-nowrap hover:bg-amber-100 transition border-2 border-amber-200">
                        Berita
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Article -->
    <section class="py-12 bg-gradient-to-b from-amber-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-amber-900 mb-8">Artikel Utama</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                <!-- Main Featured Card -->
                <div class="lg:col-span-2 rounded-2xl overflow-hidden bg-white shadow-xl border-2 border-amber-100 hover:shadow-2xl transition group">
                    <div class="relative overflow-hidden h-80 bg-gradient-to-br from-amber-600 to-amber-700">
                        <img src="{{ asset('images/blog-featured.png') }}" alt="Artikel Utama" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition"></div>
                    </div>
                    <div class="p-8">
                        <div class="flex gap-3 mb-4">
                            <span class="px-4 py-1 bg-amber-100 text-amber-700 font-bold text-sm rounded-full">Ibadah</span>
                            <span class="text-amber-600 text-sm font-semibold">15 Maret 2025</span>
                        </div>
                        <h3 class="text-2xl font-bold text-amber-900 mb-3">
                            Pentingnya Khusyu' dalam Shalat Berjamaah
                        </h3>
                        <p class="text-amber-700 mb-6 leading-relaxed">
                            Khusyu' adalah puncak dari sebuah shalat yang sempurna. Dalam artikel ini kita akan membahas secara mendalam tentang makna khusyu', cara mencapainya, dan manfaatnya bagi hati dan jiwa kita...
                        </p>
                        <a href="#" class="inline-flex items-center gap-2 text-amber-700 font-bold hover:text-amber-900 transition">
                            Baca Selengkapnya
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Side Featured Cards -->
                <div class="flex flex-col gap-6">
                    <!-- Card 1 -->
                    <div class="rounded-xl overflow-hidden bg-white shadow-lg border border-amber-100 hover:shadow-xl transition group">
                        <div class="h-40 bg-gradient-to-br from-green-400 to-green-600 overflow-hidden">
                            <img src="{{ asset('images/blog-2.png') }}" alt="Artikel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-4">
                            <span class="text-amber-600 text-xs font-bold">12 Maret 2025</span>
                            <h4 class="text-lg font-bold text-amber-900 mt-2 line-clamp-2">
                                Tips Menjaga Wudhu Sempurna
                            </h4>
                            <p class="text-sm text-amber-700 mt-2 line-clamp-2">
                                Panduan lengkap tata cara wudhu yang benar menurut tuntunan Nabi...
                            </p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="rounded-xl overflow-hidden bg-white shadow-lg border border-amber-100 hover:shadow-xl transition group">
                        <div class="h-40 bg-gradient-to-br from-blue-400 to-blue-600 overflow-hidden">
                            <img src="{{ asset('images/blog-3.png') }}" alt="Artikel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-4">
                            <span class="text-amber-600 text-xs font-bold">10 Maret 2025</span>
                            <h4 class="text-lg font-bold text-amber-900 mt-2 line-clamp-2">
                                Jadwal Kegiatan Masjid Bulan Ramadan
                            </h4>
                            <p class="text-sm text-amber-700 mt-2 line-clamp-2">
                                Informasi lengkap kegiatan ibadah dan kajian di bulan yang mulia...
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Articles Grid -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-amber-900 mb-8">Artikel Terbaru</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Article Card 1 -->
                <div class="rounded-xl overflow-hidden bg-white shadow-lg border border-amber-100 hover:shadow-xl transition hover:border-amber-300 group cursor-pointer">
                    <div class="relative h-48 bg-gradient-to-br from-purple-400 to-purple-600 overflow-hidden">
                        <img src="{{ asset('images/blog-4.png') }}" alt="Artikel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 font-bold text-xs rounded-full">Tips & Trik</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <span class="text-amber-600 text-sm font-semibold">8 Maret 2025</span>
                        <h3 class="text-lg font-bold text-amber-900 mt-2 mb-3">
                            Cara Mempersiapkan Diri untuk Shalat Tahajjud
                        </h3>
                        <p class="text-amber-700 text-sm mb-4">
                            Shalat tahajjud adalah ibadah istimewa yang memberikan manfaat spiritual luar biasa. Mari kita pelajari cara mempersiapkannya...
                        </p>
                        <div class="flex items-center gap-2 text-amber-700 font-semibold text-sm hover:text-amber-900 transition">
                            Baca Selengkapnya →
                        </div>
                    </div>
                </div>

                <!-- Article Card 2 -->
                <div class="rounded-xl overflow-hidden bg-white shadow-lg border border-amber-100 hover:shadow-xl transition hover:border-amber-300 group cursor-pointer">
                    <div class="relative h-48 bg-gradient-to-br from-indigo-400 to-indigo-600 overflow-hidden">
                        <img src="{{ asset('images/blog-5.png') }}" alt="Artikel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 font-bold text-xs rounded-full">Berita</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <span class="text-amber-600 text-sm font-semibold">5 Maret 2025</span>
                        <h3 class="text-lg font-bold text-amber-900 mt-2 mb-3">
                            Renovasi Masjid Selesai, Fasilitas Lebih Modern
                        </h3>
                        <p class="text-amber-700 text-sm mb-4">
                            Alhamdulillah, rangkaian renovasi Masjid Syatho telah selesai dengan hasil yang memuaskan. Fasilitas kini lebih modern dan nyaman...
                        </p>
                        <div class="flex items-center gap-2 text-amber-700 font-semibold text-sm hover:text-amber-900 transition">
                            Baca Selengkapnya →
                        </div>
                    </div>
                </div>

                <!-- Article Card 3 -->
                <div class="rounded-xl overflow-hidden bg-white shadow-lg border border-amber-100 hover:shadow-xl transition hover:border-amber-300 group cursor-pointer">
                    <div class="relative h-48 bg-gradient-to-br from-pink-400 to-pink-600 overflow-hidden">
                        <img src="{{ asset('images/blog-6.png') }}" alt="Artikel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 font-bold text-xs rounded-full">Ibadah</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <span class="text-amber-600 text-sm font-semibold">28 Februari 2025</span>
                        <h3 class="text-lg font-bold text-amber-900 mt-2 mb-3">
                            Manfaat Membaca Al-Qur'an Setiap Hari
                        </h3>
                        <p class="text-amber-700 text-sm mb-4">
                            Al-Qur'an adalah petunjuk bagi manusia dan obat bagi segala penyakit hati. Berikut manfaat-manfaatnya yang istimewa...
                        </p>
                        <div class="flex items-center gap-2 text-amber-700 font-semibold text-sm hover:text-amber-900 transition">
                            Baca Selengkapnya →
                        </div>
                    </div>
                </div>

                <!-- Article Card 4 -->
                <div class="rounded-xl overflow-hidden bg-white shadow-lg border border-amber-100 hover:shadow-xl transition hover:border-amber-300 group cursor-pointer">
                    <div class="relative h-48 bg-gradient-to-br from-cyan-400 to-cyan-600 overflow-hidden">
                        <img src="{{ asset('images/blog-7.png') }}" alt="Artikel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 font-bold text-xs rounded-full">Tips & Trik</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <span class="text-amber-600 text-sm font-semibold">25 Februari 2025</span>
                        <h3 class="text-lg font-bold text-amber-900 mt-2 mb-3">
                            Program Kelas Mengaji untuk Anak-Anak
                        </h3>
                        <p class="text-amber-700 text-sm mb-4">
                            Kami dengan bangga mempersembahkan program kelas mengaji gratis untuk semua anak-anak di komunitas kami. Pendaftaran sudah dibuka...
                        </p>
                        <div class="flex items-center gap-2 text-amber-700 font-semibold text-sm hover:text-amber-900 transition">
                            Baca Selengkapnya →
                        </div>
                    </div>
                </div>

                <!-- Article Card 5 -->
                <div class="rounded-xl overflow-hidden bg-white shadow-lg border border-amber-100 hover:shadow-xl transition hover:border-amber-300 group cursor-pointer">
                    <div class="relative h-48 bg-gradient-to-br from-rose-400 to-rose-600 overflow-hidden">
                        <img src="{{ asset('images/blog-8.png') }}" alt="Artikel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 font-bold text-xs rounded-full">Berita</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <span class="text-amber-600 text-sm font-semibold">20 Februari 2025</span>
                        <h3 class="text-lg font-bold text-amber-900 mt-2 mb-3">
                            Pengalaman Ziarah ke Masjid Al-Haram
                        </h3>
                        <p class="text-amber-700 text-sm mb-4">
                            Kisah inspiratif dari jamaah kami yang baru kembali dari perjalanan umrah dan menunaikan shalat di Masjid Al-Haram...
                        </p>
                        <div class="flex items-center gap-2 text-amber-700 font-semibold text-sm hover:text-amber-900 transition">
                            Baca Selengkapnya →
                        </div>
                    </div>
                </div>

                <!-- Article Card 6 -->
                <div class="rounded-xl overflow-hidden bg-white shadow-lg border border-amber-100 hover:shadow-xl transition hover:border-amber-300 group cursor-pointer">
                    <div class="relative h-48 bg-gradient-to-br from-lime-400 to-lime-600 overflow-hidden">
                        <img src="{{ asset('images/blog-9.png') }}" alt="Artikel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 font-bold text-xs rounded-full">Ibadah</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <span class="text-amber-600 text-sm font-semibold">18 Februari 2025</span>
                        <h3 class="text-lg font-bold text-amber-900 mt-2 mb-3">
                            Keutamaan Dzikir dan Doa di Masjid
                        </h3>
                        <p class="text-amber-700 text-sm mb-4">
                            Masjid adalah rumah Allah di mana kita bisa berkomunikasi langsung dengan-Nya. Mari kita pelajari pentingnya dzikir di masjid...
                        </p>
                        <div class="flex items-center gap-2 text-amber-700 font-semibold text-sm hover:text-amber-900 transition">
                            Baca Selengkapnya →
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="px-10 py-3 bg-amber-700 text-white font-bold rounded-lg hover:bg-amber-800 transition shadow-lg hover:shadow-xl">
                    Muat Lebih Banyak Artikel
                </button>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gradient-to-r from-amber-700 to-amber-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Dapatkan Artikel Terbaru</h2>
            <p class="text-amber-100 text-lg mb-8">
                Berlangganan newsletter kami untuk menerima artikel inspiratif langsung ke email Anda setiap minggu
            </p>
            
            <div class="flex gap-2 max-w-md mx-auto">
                <input 
                    type="email" 
                    placeholder="Masukkan email Anda..." 
                    class="flex-1 px-6 py-3 rounded-lg focus:outline-none"
                >
                <button class="px-8 py-3 bg-white text-amber-700 font-bold rounded-lg hover:bg-amber-50 transition">
                    Berlangganan
                </button>
            </div>
        </div>
    </section>

    <!-- Related Categories -->
    <section class="py-16 bg-amber-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-amber-900 mb-8 text-center">Kategori Artikel</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category 1 -->
                <div class="p-6 rounded-lg bg-white border-2 border-amber-200 hover:border-amber-700 hover:shadow-lg transition text-center cursor-pointer">
                    <div class="text-4xl mb-3">📖</div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Ibadah</h3>
                    <p class="text-amber-700 text-sm">12 artikel</p>
                </div>

                <!-- Category 2 -->
                <div class="p-6 rounded-lg bg-white border-2 border-amber-200 hover:border-amber-700 hover:shadow-lg transition text-center cursor-pointer">
                    <div class="text-4xl mb-3">💡</div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Tips & Trik</h3>
                    <p class="text-amber-700 text-sm">8 artikel</p>
                </div>

                <!-- Category 3 -->
                <div class="p-6 rounded-lg bg-white border-2 border-amber-200 hover:border-amber-700 hover:shadow-lg transition text-center cursor-pointer">
                    <div class="text-4xl mb-3">📰</div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Berita</h3>
                    <p class="text-amber-700 text-sm">15 artikel</p>
                </div>

                <!-- Category 4 -->
                <div class="p-6 rounded-lg bg-white border-2 border-amber-200 hover:border-amber-700 hover:shadow-lg transition text-center cursor-pointer">
                    <div class="text-4xl mb-3">✨</div>
                    <h3 class="text-lg font-bold text-amber-900 mb-2">Motivasi</h3>
                    <p class="text-amber-700 text-sm">10 artikel</p>
                </div>
            </div>
        </div>
    </section>
</x-layouts::base>