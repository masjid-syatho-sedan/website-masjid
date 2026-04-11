<x-layouts::base title="Layanan Ambulans - Masjid Syatho Sedan" active="ambulans" whatsappPhone="6282147977779" whatsappLabel="Hubungi Ambulans">

    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-red-700 via-red-600 to-red-800 overflow-hidden pt-16 pb-16 md:pt-20 md:pb-20">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mb-48"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-12">
                {{-- Left Content --}}
                <div class="flex-1 text-white">
                    <div class="inline-flex items-center gap-2 bg-red-900/40 text-red-100 text-sm font-semibold px-4 py-2 rounded-full mb-6">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Fasilitas Masjid Syatho
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                        Layanan Ambulans
                        <br>
                        <span class="text-red-200">Masjid Syatho</span>
                    </h1>
                    <p class="text-lg text-red-100 mb-8 max-w-xl">
                        Masjid Syatho Sedan menyediakan layanan ambulans gratis untuk membantu warga yang membutuhkan pertolongan darurat. Siaga melayani umat kapan pun dibutuhkan.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="#hubungi" class="inline-flex items-center gap-2 px-8 py-3 bg-white text-red-700 font-bold rounded-lg hover:bg-red-50 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                            Hubungi Sekarang
                        </a>
                        <a href="{{ route('fasilitas.ambulans.jurnal') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-red-900/40 text-white font-bold rounded-lg hover:bg-red-900/60 border border-red-400/40 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Lihat Jurnal
                        </a>
                    </div>
                </div>

                {{-- Right Icon --}}
                <div class="flex-1 flex justify-center">
                    <div class="w-72 h-72 bg-red-900/30 rounded-3xl flex items-center justify-center shadow-2xl border-2 border-red-400/30">
                        <svg class="w-40 h-40 text-white opacity-90" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 8h-3V6c0-1.1-.9-2-2-2H9C7.9 4 7 4.9 7 6v2H4c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-9c0-1.1-.9-2-2-2zm-5 9h-2v-2h-2v2H9v-2H7v-2h2v-2h2v2h2v-2h2v2h2v2h-2v2zm0-11H9V6h6v2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================================================== --}}
    {{-- SECTION 1: Cara Menghubungi Ambulans --}}
    {{-- =========================================================== --}}
    <section id="hubungi" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <span class="inline-block bg-red-100 text-red-700 font-semibold text-sm px-4 py-1 rounded-full mb-4">Kontak Darurat</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Cara Menghubungi Ambulans</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Dalam keadaan darurat, hubungi kami melalui salah satu cara berikut. Respons cepat adalah prioritas kami.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-14">
                {{-- Telepon --}}
                <div class="flex flex-col items-center text-center p-8 rounded-2xl bg-red-50 border-2 border-red-100 hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mb-5 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Telepon / WhatsApp</h3>
                    <p class="text-gray-600 mb-4">Hubungi nomor darurat ambulans masjid langsung melalui telepon atau WhatsApp</p>
                    <p class="text-2xl font-bold text-gray-900 mb-4">0821-4797-7779</p>
                    <div class="flex flex-col sm:flex-row gap-3 w-full">
                        <a href="tel:+6282147977779"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition text-sm">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                            Telepon
                        </a>
                        <a href="https://wa.me/6282147977779"
                            target="_blank" rel="noopener noreferrer"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition text-sm">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.532 5.858L0 24l6.303-1.504A11.953 11.953 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.893 0-3.671-.498-5.208-1.371l-.374-.22-3.742.892.935-3.637-.242-.386A9.956 9.956 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                            </svg>
                            WhatsApp
                        </a>
                    </div>
                    <span class="mt-3 text-sm text-gray-500">Tersedia 24 jam</span>
                </div>

                {{-- Datang Langsung --}}
                <div class="flex flex-col items-center text-center p-8 rounded-2xl bg-amber-50 border-2 border-amber-100 hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-amber-600 rounded-full flex items-center justify-center mb-5 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Datang Langsung</h3>
                    <p class="text-gray-600 mb-4">Ambulans bermarkas di kompleks Masjid Syatho, bisa langsung ditemui petugas jaga</p>
                    <p class="text-sm font-semibold text-amber-700">SEDAN RT 01 RW 04</p>
                    <p class="text-sm text-amber-600">Karanganyar, Sedan, Rembang</p>
                </div>

                {{-- Petugas Masjid --}}
                <div class="flex flex-col items-center text-center p-8 rounded-2xl bg-green-50 border-2 border-green-100 hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-5 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Melalui Petugas Masjid</h3>
                    <p class="text-gray-600 mb-4">Hubungi pengurus atau satpam masjid yang berjaga untuk segera mengkoordinasikan bantuan</p>
                    <span class="text-sm font-semibold text-green-700">Siaga di Area Masjid</span>
                    <span class="text-sm text-green-600">Waktu sholat & saat ramai</span>
                </div>
            </div>

            {{-- Langkah-langkah --}}
            <div class="bg-gradient-to-br from-red-50 to-amber-50 rounded-2xl p-8 border border-red-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Langkah Ketika Membutuhkan Ambulans</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach([
                        ['step' => '1', 'title' => 'Tetap Tenang', 'desc' => 'Pastikan kondisi pasien aman dan jangan panik agar dapat menyampaikan informasi dengan jelas'],
                        ['step' => '2', 'title' => 'Hubungi Kami', 'desc' => 'Segera hubungi nomor darurat atau temui petugas masjid terdekat'],
                        ['step' => '3', 'title' => 'Sampaikan Lokasi', 'desc' => 'Berikan informasi lokasi yang jelas dan kondisi pasien kepada petugas'],
                        ['step' => '4', 'title' => 'Tunggu Bantuan', 'desc' => 'Petugas kami akan segera tiba. Pastikan jalur akses tidak terhalang'],
                    ] as $item)
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-red-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-3 shadow">
                            {{ $item['step'] }}
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1">{{ $item['title'] }}</h4>
                        <p class="text-sm text-gray-600">{{ $item['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- =========================================================== --}}
    {{-- SECTION 2: Detail Fasilitas Ambulans --}}
    {{-- =========================================================== --}}
    <section id="fasilitas" class="py-20 bg-gradient-to-r from-amber-50 to-red-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <span class="inline-block bg-amber-100 text-amber-700 font-semibold text-sm px-4 py-1 rounded-full mb-4">Spesifikasi & Layanan</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Detail Fasilitas Ambulans</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Ambulans Masjid Syatho dilengkapi dengan perlengkapan medis standar dan dioperasikan oleh tenaga terlatih untuk memberikan pertolongan pertama yang optimal.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                {{-- Spesifikasi Kendaraan --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                            </svg>
                        </span>
                        Spesifikasi Kendaraan
                    </h3>
                    <div class="space-y-4">
                        @foreach([
                            ['label' => 'Jenis Kendaraan', 'value' => 'Ambulans Minibus'],
                            ['label' => 'Kapasitas Pasien', 'value' => '1–2 pasien (berbaring)'],
                            ['label' => 'Wilayah Layanan', 'value' => 'Kecamatan Sedan & sekitarnya'],
                            ['label' => 'Status Layanan', 'value' => 'Gratis untuk warga sekitar'],
                            ['label' => 'Jam Operasional', 'value' => '24 Jam (on-call)'],
                        ] as $spec)
                        <div class="flex items-center justify-between py-3 border-b border-amber-200">
                            <span class="text-gray-600 font-medium">{{ $spec['label'] }}</span>
                            <span class="text-gray-900 font-semibold text-right">{{ $spec['value'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Perlengkapan Medis --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                            </svg>
                        </span>
                        Perlengkapan Medis
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach([
                            'Tandu & brankar pasien',
                            'Tabung oksigen portabel',
                            'Peralatan pertolongan pertama (P3K)',
                            'Tensimeter & stetoskop',
                            'Infus set & cairan IV',
                            'Selimut medis & bantal',
                            'Alat penjepit (bidai) tulang',
                            'Lampu darurat & sirine',
                        ] as $item)
                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-amber-100">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-700">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Ketentuan Penggunaan --}}
            <div class="mt-14">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Ketentuan Penggunaan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-white rounded-xl border-2 border-green-100 hover:shadow-md transition">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Gratis untuk Warga</h4>
                        <p class="text-sm text-gray-600">Layanan ambulans tidak dipungut biaya bagi warga sekitar yang membutuhkan pertolongan darurat</p>
                    </div>
                    <div class="p-6 bg-white rounded-xl border-2 border-blue-100 hover:shadow-md transition">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Prioritas Darurat</h4>
                        <p class="text-sm text-gray-600">Ambulans diprioritaskan untuk kondisi darurat medis. Untuk kebutuhan non-darurat harap koordinasi terlebih dahulu</p>
                    </div>
                    <div class="p-6 bg-white rounded-xl border-2 border-amber-100 hover:shadow-md transition">
                        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Dioperasikan Relawan</h4>
                        <p class="text-sm text-gray-600">Ambulans dioperasikan oleh relawan terlatih dari pengurus dan jamaah masjid yang siap membantu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================================================== --}}
    {{-- SECTION 3: Sejarah Ambulans (Placeholder) --}}
    {{-- =========================================================== --}}
    <section id="sejarah" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <span class="inline-block bg-amber-100 text-amber-700 font-semibold text-sm px-4 py-1 rounded-full mb-4">Latar Belakang</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Sejarah Ambulans Masjid Syatho</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Perjalanan panjang hadirnya ambulans sebagai wujud kepedulian dan pengabdian Masjid Syatho kepada masyarakat sekitar.
                </p>
            </div>

            {{-- Timeline --}}
            <div class="relative">
                {{-- Garis tengah timeline (desktop) --}}
                <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-0.5 bg-amber-200 -translate-x-1/2"></div>

                <div class="space-y-12">

                    {{-- Item 1: Awal Mula Gagasan --}}
                    <div class="relative flex flex-col md:flex-row items-center gap-8">
                        <div class="flex-1 md:text-right md:pr-12">
                            <div class="inline-block bg-amber-50 border-2 border-amber-200 rounded-2xl p-6 hover:shadow-md transition text-left md:text-right">
                                <span class="inline-block bg-amber-200 text-amber-800 text-xs font-bold px-3 py-1 rounded-full mb-3">
                                    [TAHUN — PLACEHOLDER]
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Awal Mula Gagasan</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    <em class="text-amber-600">[Placeholder — isi dengan cerita awal mula ide pengadaan ambulans, misalnya: kondisi warga yang kesulitan
                                    transportasi ke rumah sakit, kejadian yang menjadi pemicu, atau inisiatif dari pengurus masjid
                                    dan tokoh masyarakat setempat.]</em>
                                </p>
                            </div>
                        </div>
                        {{-- Titik tengah --}}
                        <div class="hidden md:flex w-10 h-10 bg-amber-600 rounded-full items-center justify-center shadow-lg flex-shrink-0 z-10">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                        </div>
                        <div class="flex-1 hidden md:block"></div>
                    </div>

                    {{-- Item 2: Penggalangan Dana --}}
                    <div class="relative flex flex-col md:flex-row items-center gap-8">
                        <div class="flex-1 hidden md:block"></div>
                        {{-- Titik tengah --}}
                        <div class="hidden md:flex w-10 h-10 bg-amber-600 rounded-full items-center justify-center shadow-lg flex-shrink-0 z-10">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                            </svg>
                        </div>
                        <div class="flex-1 md:pl-12">
                            <div class="inline-block bg-blue-50 border-2 border-blue-200 rounded-2xl p-6 hover:shadow-md transition">
                                <span class="inline-block bg-blue-200 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-3">
                                    [TAHUN — PLACEHOLDER]
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Penggalangan Dana & Dukungan</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    <em class="text-blue-600">[Placeholder — ceritakan proses penggalangan dana dari jamaah, donatur, atau lembaga. Siapa saja yang
                                    berkontribusi, berapa lama proses berlangsung, dan bagaimana antusiasme masyarakat dalam mendukung
                                    pengadaan ambulans ini.]</em>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Item 3: Pengadaan Kendaraan --}}
                    <div class="relative flex flex-col md:flex-row items-center gap-8">
                        <div class="flex-1 md:text-right md:pr-12">
                            <div class="inline-block bg-green-50 border-2 border-green-200 rounded-2xl p-6 hover:shadow-md transition text-left md:text-right">
                                <span class="inline-block bg-green-200 text-green-800 text-xs font-bold px-3 py-1 rounded-full mb-3">
                                    [TAHUN — PLACEHOLDER]
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Pengadaan Kendaraan</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    <em class="text-green-600">[Placeholder — uraikan proses pembelian atau perolehan kendaraan ambulans. Dari mana kendaraan
                                    berasal, apakah hibah, pembelian, atau hasil lelang. Modifikasi apa saja yang dilakukan agar
                                    sesuai standar ambulans.]</em>
                                </p>
                            </div>
                        </div>
                        <div class="hidden md:flex w-10 h-10 bg-green-600 rounded-full items-center justify-center shadow-lg flex-shrink-0 z-10">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                            </svg>
                        </div>
                        <div class="flex-1 hidden md:block"></div>
                    </div>

                    {{-- Item 4: Proses Penyerahan --}}
                    <div class="relative flex flex-col md:flex-row items-center gap-8">
                        <div class="flex-1 hidden md:block"></div>
                        <div class="hidden md:flex w-10 h-10 bg-red-600 rounded-full items-center justify-center shadow-lg flex-shrink-0 z-10">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 8h-3V6c0-1.1-.9-2-2-2H9C7.9 4 7 4.9 7 6v2H4c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-9c0-1.1-.9-2-2-2zm-5 9h-2v-2h-2v2H9v-2H7v-2h2v-2h2v2h2v-2h2v2h2v2h-2v2zm0-11H9V6h6v2z"/>
                            </svg>
                        </div>
                        <div class="flex-1 md:pl-12">
                            <div class="inline-block bg-red-50 border-2 border-red-200 rounded-2xl p-6 hover:shadow-md transition">
                                <span class="inline-block bg-red-200 text-red-800 text-xs font-bold px-3 py-1 rounded-full mb-3">
                                    [TANGGAL — PLACEHOLDER]
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Seremoni Penyerahan Ambulans</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    <em class="text-red-600">[Placeholder — ceritakan momen penyerahan resmi ambulans kepada masjid. Siapa yang menyerahkan
                                    (donatur utama, pemerintah, atau lembaga lain), siapa yang menerima dari pihak masjid,
                                    acara apa yang diselenggarakan, serta doa dan harapan yang menyertai penyerahan tersebut.]</em>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Item 5: Mulai Beroperasi --}}
                    <div class="relative flex flex-col md:flex-row items-center gap-8">
                        <div class="flex-1 md:text-right md:pr-12">
                            <div class="inline-block bg-purple-50 border-2 border-purple-200 rounded-2xl p-6 hover:shadow-md transition text-left md:text-right">
                                <span class="inline-block bg-purple-200 text-purple-800 text-xs font-bold px-3 py-1 rounded-full mb-3">
                                    [TANGGAL — PLACEHOLDER]
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Mulai Beroperasi Aktif</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    <em class="text-purple-600">[Placeholder — kisahkan awal ambulans mulai aktif beroperasi melayani masyarakat. Berapa warga
                                    yang telah dibantu, testimoni awal dari penerima manfaat, serta komitmen pengurus masjid
                                    dalam menjaga keberlangsungan layanan ini.]</em>
                                </p>
                            </div>
                        </div>
                        <div class="hidden md:flex w-10 h-10 bg-purple-600 rounded-full items-center justify-center shadow-lg flex-shrink-0 z-10">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <div class="flex-1 hidden md:block"></div>
                    </div>

                </div>
            </div>

            {{-- Catatan Editor --}}
            <div class="mt-16 p-6 bg-yellow-50 border-2 border-yellow-300 rounded-2xl flex gap-4">
                <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                </svg>
                <div>
                    <p class="font-bold text-yellow-800 mb-1">Catatan untuk Editor</p>
                    <p class="text-sm text-yellow-700">
                        Bagian sejarah di atas masih berupa <strong>placeholder</strong>. Mohon diisi dengan narasi sejarah nyata
                        ambulans Masjid Syatho — termasuk tahun kejadian, nama tokoh yang terlibat, dan foto dokumentasi
                        jika tersedia. Hubungi pengurus masjid untuk mendapatkan informasi yang akurat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-r from-red-700 to-red-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Butuh Bantuan Segera?</h2>
            <p class="text-lg text-red-100 mb-8">
                Jangan ragu untuk menghubungi kami. Ambulans Masjid Syatho siap hadir untuk Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:+6282147977779"
                    class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-red-700 font-bold rounded-lg hover:bg-red-50 transition text-lg shadow-lg">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                    </svg>
                    Telepon Sekarang
                </a>
                <a href="https://wa.me/6282147977779"
                    target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-green-500 text-white font-bold rounded-lg hover:bg-green-400 transition text-lg shadow-lg">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.532 5.858L0 24l6.303-1.504A11.953 11.953 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.893 0-3.671-.498-5.208-1.371l-.374-.22-3.742.892.935-3.637-.242-.386A9.956 9.956 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                    </svg>
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </section>

</x-layouts::base>
