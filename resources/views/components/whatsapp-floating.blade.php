@props(['phone' => '6281353652777', 'label' => 'Call Center Masjid'])

<!-- Floating WhatsApp Button -->
<div class="fixed bottom-6 right-6 z-40">
    <a href="https://wa.me/{{ $phone }}?text=Assalamu%20alaikum%20wa%20rahmatullahi%20wa%20barakatuh"
       target="_blank"
       rel="noopener noreferrer"
       class="flex items-center gap-2 sm:gap-3 px-4 sm:px-5 py-3 sm:py-4 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group">

        <!-- WhatsApp Icon -->
        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="white" viewBox="0 0 24 24">
            <path d="M20.52 3.48C18.25 1.23 15.3 0 12.04 0 5.55 0 .27 5.28.27 11.74c0 2.06.54 4.09 1.57 5.87L0 24l6.35-1.84c1.72.94 3.67 1.44 5.69 1.44h.01c6.49 0 11.77-5.28 11.77-11.77 0-3.14-1.23-6.1-3.48-8.32zM12.04 21.16c-1.77 0-3.51-.47-5.02-1.36l-.36-.21-3.72 1.08 1.1-3.66-.23-.37c-1.05-1.67-1.6-3.6-1.6-5.59 0-5.39 4.39-9.78 9.78-9.78 2.62 0 5.08 1.02 6.93 2.87 1.85 1.85 2.87 4.31 2.87 6.93 0 5.39-4.39 9.78-9.78 9.78zm5.33-7.31c-.29-.15-1.73-.85-2-.95-.27-.1-.46-.15-.66.15-.2.3-.76.95-.93 1.15-.17.19-.34.21-.63.07-.29-.15-1.24-.46-2.36-1.46-.87-.78-1.46-1.74-1.63-2.04-.17-.3-.02-.45.13-.6.13-.13.29-.34.44-.51.15-.17.2-.29.29-.49.1-.19.05-.36-.02-.51-.07-.15-.66-1.59-.9-2.18-.24-.57-.48-.49-.66-.5-.17-.01-.37-.01-.56-.01-.19 0-.51.07-.78.37-.27.29-1.03 1.01-1.03 2.45 0 1.44 1.05 2.84 1.2 3.04.15.2 2.07 3.17 5.01 4.43.7.3 1.25.48 1.67.61.7.22 1.34.19 1.84.12.56-.08 1.73-.71 1.97-1.39.24-.69.24-1.27.17-1.39-.08-.12-.27-.2-.56-.34z"/>
        </svg>

        <!-- Text Label (hidden on mobile) -->
        <span class="hidden sm:inline text-sm font-semibold whitespace-nowrap">
            {{ $label }}
        </span>
    </a>
</div>
