// Registrasi Service Worker untuk PWA
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker
            .register('/sw.js')
            .then((registration) => {
                // Cek update service worker secara berkala (setiap 60 detik)
                setInterval(() => registration.update(), 60_000);

                registration.addEventListener('updatefound', () => {
                    const newWorker = registration.installing;
                    newWorker.addEventListener('statechange', () => {
                        if (
                            newWorker.state === 'installed' &&
                            navigator.serviceWorker.controller
                        ) {
                            // Versi baru tersedia — reload otomatis untuk update
                            console.info('[PWA] Versi baru tersedia, memperbarui...');
                            window.location.reload();
                        }
                    });
                });
            })
            .catch((err) => console.warn('[PWA] Registrasi service worker gagal:', err));

        // Reload jika service worker baru langsung mengambil alih (skipWaiting)
        navigator.serviceWorker.addEventListener('controllerchange', () => {
            window.location.reload();
        });
    });
}
