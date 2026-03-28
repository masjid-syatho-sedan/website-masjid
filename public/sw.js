// Service Worker - Masjid Syatho Sedan
// Versi cache diupdate otomatis saat ada perubahan

const CACHE_VERSION = 'v1';
const STATIC_CACHE = `masjid-static-${CACHE_VERSION}`;
const DYNAMIC_CACHE = `masjid-dynamic-${CACHE_VERSION}`;

// Aset statis yang selalu di-cache saat install
const PRECACHE_ASSETS = [
    '/',
    '/manifest.json',
    '/favicon.ico',
    '/favicon.svg',
    '/apple-touch-icon.png',
    '/icons/icon-192x192.png',
    '/icons/icon-512x512.png',
];

// ─── Install ───────────────────────────────────────────────────────────────
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(STATIC_CACHE).then((cache) => cache.addAll(PRECACHE_ASSETS))
    );
    // Langsung aktif tanpa menunggu tab lama ditutup
    self.skipWaiting();
});

// ─── Activate ──────────────────────────────────────────────────────────────
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(
                keys
                    .filter((key) => key !== STATIC_CACHE && key !== DYNAMIC_CACHE)
                    .map((key) => caches.delete(key))
            )
        )
    );
    // Ambil kendali semua tab tanpa perlu reload manual
    self.clients.claim();
});

// ─── Fetch ─────────────────────────────────────────────────────────────────
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);

    // Abaikan request non-GET dan request dari admin/portal Filament
    if (request.method !== 'GET') return;
    if (url.pathname.startsWith('/admin')) return;
    if (url.pathname.startsWith('/livewire')) return;

    // Aset statis Vite (punya hash di nama file) → Cache-First
    if (isStaticAsset(url)) {
        event.respondWith(cacheFirst(request));
        return;
    }

    // Font & gambar → Cache-First dengan fallback jaringan
    if (isMediaAsset(url)) {
        event.respondWith(cacheFirst(request));
        return;
    }

    // Halaman HTML → Network-First agar selalu up-to-date
    if (request.headers.get('accept')?.includes('text/html')) {
        event.respondWith(networkFirst(request));
        return;
    }

    // Lainnya → Network-First
    event.respondWith(networkFirst(request));
});

// ─── Strategi Cache ────────────────────────────────────────────────────────

/**
 * Cache-First: ambil dari cache, kalau tidak ada baru ke jaringan.
 * Cocok untuk aset dengan hash (CSS, JS Vite) dan gambar.
 */
async function cacheFirst(request) {
    const cached = await caches.match(request);
    if (cached) return cached;

    try {
        const response = await fetch(request);
        if (response.ok) {
            const cache = await caches.open(DYNAMIC_CACHE);
            cache.put(request, response.clone());
        }
        return response;
    } catch {
        return new Response('Konten tidak tersedia offline.', { status: 503 });
    }
}

/**
 * Network-First: utamakan jaringan, fallback ke cache bila offline.
 * Cocok untuk halaman HTML agar selalu mendapat konten terbaru.
 */
async function networkFirst(request) {
    try {
        const response = await fetch(request);
        if (response.ok) {
            const cache = await caches.open(DYNAMIC_CACHE);
            cache.put(request, response.clone());
        }
        return response;
    } catch {
        const cached = await caches.match(request);
        if (cached) return cached;

        // Fallback ke halaman utama jika tersedia di cache
        const fallback = await caches.match('/');
        return fallback ?? new Response('Anda sedang offline.', {
            status: 503,
            headers: { 'Content-Type': 'text/plain; charset=utf-8' },
        });
    }
}

// ─── Helper ────────────────────────────────────────────────────────────────

function isStaticAsset(url) {
    // File Vite memiliki hash di nama: build/assets/app-AbCdEf12.js
    return url.pathname.startsWith('/build/') ||
        /\.(js|css)$/.test(url.pathname);
}

function isMediaAsset(url) {
    return /\.(png|jpg|jpeg|gif|svg|webp|ico|woff2?|ttf|eot)$/.test(url.pathname);
}
