<nav class="sticky top-0 z-50 bg-white border-b border-amber-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a wire:navigate href="/" class="flex-shrink-0 flex items-center gap-2 hover:opacity-80 transition">
                <img src="{{ asset('logo.png') }}" alt="MASJID SYATHO SEDAN" class="h-10 w-auto">
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-amber-900">MASJID SYATHO</span>
                    <span class="text-xs text-amber-700">Rembang</span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">
                <a wire:navigate href="/"
                    class="transition font-bold {{ $active === 'home' ? 'text-amber-600 border-b-2 border-amber-500 pb-0.5' : 'text-amber-700 hover:text-amber-500' }}">
                    Beranda
                </a>
                <a wire:navigate href="/blog"
                    class="transition font-bold {{ $active === 'artikel' ? 'text-amber-600 border-b-2 border-amber-500 pb-0.5' : 'text-amber-700 hover:text-amber-500' }}">
                    Artikel
                </a>

                <!-- Portal -->
                @auth
                    <a wire:navigate href="{{ route('dashboard') }}"
                        class="transition font-bold {{ $active === 'portal' ? 'text-amber-600 border-b-2 border-amber-500 pb-0.5' : 'text-amber-700 hover:text-amber-500' }}">
                        Portal Masjid
                    </a>
                @else
                    <a wire:navigate href="{{ route('login') }}"
                        class="transition font-bold {{ $active === 'portal' ? 'text-amber-600 border-b-2 border-amber-500 pb-0.5' : 'text-amber-700 hover:text-amber-500' }}">
                        Portal Masjid
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button class="text-amber-700 hover:text-amber-600" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden pb-4 border-t border-amber-100">
            <a wire:navigate href="/"
                class="block px-3 py-2 transition font-bold {{ $active === 'home' ? 'text-amber-600 bg-amber-50 border-l-4 border-amber-500' : 'text-amber-700 hover:text-amber-500 hover:bg-amber-50' }}">
                Beranda
            </a>
            <a wire:navigate href="/blog"
                class="block px-3 py-2 transition font-bold {{ $active === 'artikel' ? 'text-amber-600 bg-amber-50 border-l-4 border-amber-500' : 'text-amber-700 hover:text-amber-500 hover:bg-amber-50' }}">
                Artikel
            </a>

            {{-- Portal --}}
            @auth
                <a wire:navigate href="{{ route('dashboard') }}"
                    class="block px-3 py-2 transition font-bold {{ $active === 'portal' ? 'text-amber-600 bg-amber-50 border-l-4 border-amber-500' : 'text-amber-700 hover:text-amber-500 hover:bg-amber-50' }}">
                    Portal Masjid
                </a>
            @else
                <a wire:navigate href="{{ route('login') }}"
                    class="block px-3 py-2 transition font-bold {{ $active === 'portal' ? 'text-amber-600 bg-amber-50 border-l-4 border-amber-500' : 'text-amber-700 hover:text-amber-500 hover:bg-amber-50' }}">
                    Portal Masjid
                </a>
            @endauth
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
</script>