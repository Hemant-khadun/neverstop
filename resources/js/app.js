import './bootstrap';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import focus from '@alpinejs/focus';
import mask from '@alpinejs/mask';
import persist from '@alpinejs/persist';
import collapse from '@alpinejs/collapse';
import Clipboard from "@ryangjchandler/alpine-clipboard";

window.Alpine = Alpine;
Alpine.plugin(intersect);
Alpine.plugin(focus);
Alpine.plugin(mask);
Alpine.plugin(persist);
Alpine.plugin(Clipboard);
Alpine.plugin(collapse);
Alpine.start();


document.addEventListener("DOMContentLoaded", function() {
    function submitLogoutForm(){
        document.getElementById('logout-form').submit();
    }
});