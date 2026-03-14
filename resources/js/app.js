import Trix from 'trix';
import 'trix/dist/trix.css';

// Trix event listeners untuk sync dengan Livewire
document.addEventListener('trix-change', function(event) {
    const editor = event.target;
    const inputId = editor.getAttribute('input');
    const hiddenInput = document.getElementById(inputId);
    if (hiddenInput) {
        hiddenInput.value = editor.innerHTML;
        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
    }
});

document.addEventListener('trix-file-accept', function(event) {
    event.preventDefault();
});

// Initialize Trix editors yang sudah ada dengan konten dari hidden input
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('trix-editor').forEach(editor => {
        const inputId = editor.getAttribute('input');
        const hiddenInput = document.getElementById(inputId);
        if (hiddenInput && hiddenInput.value) {
            editor.innerHTML = hiddenInput.value;
        }
    });
});
