import './bootstrap';
import Alpine from 'alpinejs';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

window.Alpine = Alpine;
window.notyf = new Notyf({
    duration: 3000,
    position: {
        x: 'center',
        y: 'top',
    },
});

Alpine.start();
