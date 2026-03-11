<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <style>
            /* Reset & base */
            *, *::before, *::after { box-sizing: border-box; }

            body {
                margin: 0;
                min-height: 100vh;
                background: #fffbeb;
                display: flex;
            }

            /* ===== SIDEBAR ===== */
            .sidebar {
                width: 260px;
                min-height: 100vh;
                flex-shrink: 0;
                display: flex;
                flex-direction: column;
                position: sticky;
                top: 0;
                height: 100vh;
                overflow: hidden;
                background: linear-gradient(170deg, #78350f 0%, #92400e 30%, #b45309 70%, #d97706 100%);
                box-shadow: 4px 0 32px rgba(120,53,15,0.25);
                z-index: 40;
            }

            /* Decorative overlay */
            .sidebar::before {
                content: '';
                position: absolute;
                bottom: 0; left: 0; right: 0;
                height: 120px;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='8' fill='none' stroke='white' stroke-width='1'/%3E%3C/svg%3E");
                opacity: 0.04;
                pointer-events: none;
            }

            /* Top glow line */
            .sidebar-glow {
                position: absolute;
                top: 0; left: 50%;
                transform: translateX(-50%);
                width: 100px; height: 1px;
                background: linear-gradient(90deg, transparent, #fde68a, transparent);
            }

            /* ---- Sidebar Header ---- */
            .sidebar-header {
                position: relative;
                padding: 20px 16px 16px;
                border-bottom: 1px solid rgba(255,255,255,0.1);
                flex-shrink: 0;
            }

            .sidebar-brand {
                display: flex;
                align-items: center;
                gap: 12px;
                text-decoration: none;
            }

            .brand-icon {
                width: 40px; height: 40px;
                border-radius: 12px;
                background: linear-gradient(135deg, #fde68a, #f59e0b);
                display: flex; align-items: center; justify-content: center;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                flex-shrink: 0;
                transition: transform 0.2s;
            }
            .sidebar-brand:hover .brand-icon { transform: scale(1.05); }

            .brand-text p:first-child {
                color: #fff;
                font-weight: 700;
                font-size: 0.9rem;
                margin: 0;
                line-height: 1.2;
            }
            .brand-text p:last-child {
                color: rgba(253,230,138,0.75);
                font-size: 0.72rem;
                margin: 0;
                line-height: 1.2;
            }

            /* ---- Sidebar Nav ---- */
            .sidebar-nav {
                flex: 1;
                overflow-y: auto;
                padding: 12px 10px;
            }
            .sidebar-nav::-webkit-scrollbar { width: 3px; }
            .sidebar-nav::-webkit-scrollbar-thumb {
                background: rgba(251,191,36,0.25);
                border-radius: 99px;
            }

            .nav-section {
                font-size: 0.62rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: rgba(253,230,138,0.4);
                padding: 0 12px;
                margin: 12px 0 4px;
            }
            .nav-section:first-child { margin-top: 4px; }

            .nav-item {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 9px 12px;
                border-radius: 10px;
                font-size: 0.855rem;
                font-weight: 500;
                color: rgba(254,243,199,0.8);
                text-decoration: none;
                transition: all 0.18s ease;
                position: relative;
                margin-bottom: 2px;
            }
            .nav-item:hover {
                color: #fff;
                background: rgba(255,255,255,0.1);
                transform: translateX(2px);
            }
            .nav-item.active {
                background: rgba(255,255,255,0.16);
                color: #fff;
                box-shadow: inset 0 1px 0 rgba(255,255,255,0.12), 0 2px 8px rgba(0,0,0,0.12);
            }
            .nav-item.active::after {
                content: '';
                position: absolute;
                right: 0; top: 50%;
                transform: translateY(-50%);
                width: 3px; height: 55%;
                background: #fde68a;
                border-radius: 99px;
            }

            .nav-icon {
                width: 30px; height: 30px;
                border-radius: 8px;
                background: rgba(255,255,255,0.08);
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
                transition: background 0.18s;
            }
            .nav-item:hover .nav-icon,
            .nav-item.active .nav-icon {
                background: rgba(255,255,255,0.18);
            }

            /* ---- Sidebar Bottom ---- */
            .sidebar-bottom {
                flex-shrink: 0;
                padding: 10px 10px 4px;
                border-top: 1px solid rgba(255,255,255,0.1);
            }

            /* ---- User Card ---- */
            .sidebar-user {
                flex-shrink: 0;
                padding: 10px 10px 16px;
                border-top: 1px solid rgba(255,255,255,0.1);
            }
            .user-card {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 12px;
                border-radius: 12px;
                background: rgba(255,255,255,0.07);
                border: 1px solid rgba(255,255,255,0.12);
            }
            .avatar-ring {
                padding: 2px;
                background: linear-gradient(135deg, #fbbf24, #d97706);
                border-radius: 50%;
                flex-shrink: 0;
            }
            .avatar-inner {
                width: 32px; height: 32px;
                border-radius: 50%;
                background: #7c2d12;
                display: flex; align-items: center; justify-content: center;
                font-weight: 700;
                font-size: 0.72rem;
                color: #fef3c7;
            }
            .user-info { flex: 1; min-width: 0; }
            .user-name {
                color: #fff;
                font-size: 0.8rem;
                font-weight: 600;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                line-height: 1.2;
            }
            .user-email {
                color: rgba(253,230,138,0.6);
                font-size: 0.68rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                line-height: 1.2;
            }
            .user-action {
                color: rgba(253,230,138,0.6);
                padding: 4px;
                border-radius: 6px;
                cursor: pointer;
                transition: all 0.15s;
                background: none;
                border: none;
            }
            .user-action:hover {
                color: #fff;
                background: rgba(255,255,255,0.1);
            }

            /* ===== MAIN WRAPPER ===== */
            .main-wrapper {
                flex: 1;
                display: flex;
                flex-direction: column;
                min-width: 0;
                min-height: 100vh;
                background: linear-gradient(160deg, #fffbeb 0%, #fef9ee 60%, #fff7ed 100%);
            }

            /* ===== MOBILE HEADER ===== */
            .mobile-header {
                display: none;
                align-items: center;
                justify-content: space-between;
                padding: 12px 16px;
                background: linear-gradient(135deg, #92400e, #b45309, #d97706);
                border-bottom: 1px solid rgba(251,191,36,0.2);
                box-shadow: 0 2px 16px rgba(120,53,15,0.3);
                position: sticky;
                top: 0;
                z-index: 30;
            }

            /* Mobile sidebar overlay */
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 39;
                backdrop-filter: blur(2px);
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 1023px) {
                body { display: block; }

                .sidebar {
                    position: fixed;
                    top: 0; left: 0;
                    height: 100vh;
                    transform: translateX(-100%);
                    transition: transform 0.3s ease;
                    z-index: 50;
                }
                .sidebar.open {
                    transform: translateX(0);
                }
                .sidebar-overlay.show { display: block; }

                .mobile-header { display: flex; }
                .main-wrapper { min-height: calc(100vh - 57px); }
            }

            @keyframes pulse-glow {
                0%, 100% { box-shadow: 0 0 0 0 rgba(251,191,36,0.3); }
                50% { box-shadow: 0 0 0 5px rgba(251,191,36,0); }
            }
            .pulse-glow { animation: pulse-glow 2.5s ease-in-out infinite; }
        </style>
    </head>
    <body>

        {{-- ===================== SIDEBAR ===================== --}}
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-glow"></div>

            {{-- Header --}}
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" wire:navigate class="sidebar-brand">
                    <div class="brand-icon">
                        <svg width="20" height="20" fill="#78350f" viewBox="0 0 24 24">
                            <path d="M6 19V9.5C6 8.1 7.1 7 8.5 7H10V5c0-1.1.9-2 2-2s2 .9 2 2v2h1.5C16.9 7 18 8.1 18 9.5V19H6zm4-6h4v-2h-4v2zm0 4h4v-2h-4v2z"/>
                        </svg>
                    </div>
                    <div class="brand-text">
                        <p>Masjid Syatho</p>
                        <p>Portal Manajemen</p>
                    </div>
                </a>
            </div>

            {{-- Nav --}}
            <nav class="sidebar-nav">
                <p class="nav-section">Menu Utama</p>

                <a href="{{ route('dashboard') }}" wire:navigate
                   class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg width="16" height="16" fill="none" stroke="rgba(254,243,199,0.9)" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </span>
                    {{ __('Dashboard') }}
                </a>

                {{-- Tambahkan menu lain di sini --}}
            </nav>

            {{-- Bottom links --}}
            <div class="sidebar-bottom">
                <p class="nav-section" style="margin-top:4px;">Sumber Daya</p>
                <a href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="nav-item">
                    <span class="nav-icon">
                        <svg width="16" height="16" fill="none" stroke="rgba(254,243,199,0.9)" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </span>
                    {{ __('Repository') }}
                </a>
                <a href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="nav-item">
                    <span class="nav-icon">
                        <svg width="16" height="16" fill="none" stroke="rgba(254,243,199,0.9)" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </span>
                    {{ __('Documentation') }}
                </a>
            </div>

            {{-- User Card (Desktop) --}}
            <div class="sidebar-user">
                <div class="user-card">
                    <div class="avatar-ring pulse-glow">
                        <div class="avatar-inner">{{ auth()->user()->initials() }}</div>
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-email">{{ auth()->user()->email }}</div>
                    </div>
                    <flux:dropdown position="top" align="end">
                        <button class="user-action">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                            </svg>
                        </button>
                        <flux:menu class="border border-amber-200 shadow-2xl rounded-xl overflow-hidden min-w-44">
                            <flux:menu.radio.group>
                                <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate
                                    class="text-amber-800 hover:bg-amber-50">
                                    {{ __('Settings') }}
                                </flux:menu.item>
                            </flux:menu.radio.group>
                            <flux:menu.separator class="bg-amber-100"/>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item as="button" type="submit"
                                    icon="arrow-right-start-on-rectangle"
                                    class="w-full cursor-pointer text-red-600 hover:bg-red-50"
                                    data-test="logout-button">
                                    {{ __('Log out') }}
                                </flux:menu.item>
                            </form>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </aside>

        {{-- Overlay mobile --}}
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

        {{-- ===================== MAIN WRAPPER ===================== --}}
        <div class="main-wrapper">

            {{-- Mobile Header --}}
            <header class="mobile-header">
                <button onclick="openSidebar()"
                    style="background:rgba(255,255,255,0.1);border:none;border-radius:8px;padding:6px;cursor:pointer;color:#fef3c7;display:flex;align-items:center;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#fde68a,#f59e0b);display:flex;align-items:center;justify-content:center;">
                        <svg width="15" height="15" fill="#78350f" viewBox="0 0 24 24">
                            <path d="M6 19V9.5C6 8.1 7.1 7 8.5 7H10V5c0-1.1.9-2 2-2s2 .9 2 2v2h1.5C16.9 7 18 8.1 18 9.5V19H6z"/>
                        </svg>
                    </div>
                    <span style="color:#fff;font-weight:700;font-size:0.9rem;">Masjid Syatho</span>
                </div>

                <flux:dropdown position="top" align="end">
                    <button style="background:rgba(255,255,255,0.1);border:none;border-radius:10px;padding:4px 8px;cursor:pointer;display:flex;align-items:center;gap:6px;">
                        <div class="avatar-ring">
                            <div class="avatar-inner" style="width:26px;height:26px;font-size:0.65rem;">
                                {{ auth()->user()->initials() }}
                            </div>
                        </div>
                        <svg width="12" height="12" fill="none" stroke="rgba(253,230,138,0.8)" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <flux:menu class="border border-amber-200 shadow-2xl rounded-xl overflow-hidden min-w-52">
                        <div style="display:flex;align-items:center;gap:10px;padding:12px;background:linear-gradient(to right,#fffbeb,#fef9c3);border-bottom:1px solid #fde68a;">
                            <div class="avatar-ring">
                                <div class="avatar-inner">{{ auth()->user()->initials() }}</div>
                            </div>
                            <div style="min-width:0;">
                                <p style="color:#78350f;font-weight:600;font-size:0.85rem;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</p>
                                <p style="color:#b45309;font-size:0.72rem;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate class="text-amber-800 hover:bg-amber-50">
                                {{ __('Settings') }}
                            </flux:menu.item>
                        </flux:menu.radio.group>
                        <flux:menu.separator class="bg-amber-100"/>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                                class="w-full cursor-pointer text-red-600 hover:bg-red-50" data-test="logout-button">
                                {{ __('Log out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            </header>

            {{-- Page Content --}}
            <main style="flex:1;padding:0;">
                {{ $slot }}
            </main>
        </div>

        <script>
            function openSidebar() {
                document.getElementById('sidebar').classList.add('open');
                document.getElementById('sidebarOverlay').classList.add('show');
            }
            function closeSidebar() {
                document.getElementById('sidebar').classList.remove('open');
                document.getElementById('sidebarOverlay').classList.remove('show');
            }
        </script>

        @fluxScripts
    </body>
</html>