import './bootstrap';
import '@fortawesome/fontawesome-free/js/all';
import ScrollReveal from 'scrollreveal';
import 'animate.css';

import { createPopper } from '@popperjs/core';

document.addEventListener('DOMContentLoaded', function () {
    ScrollReveal().reveal('.aos-init', {
      duration: 600,
      distance: '20px',
      easing: 'ease-in-out',
      origin: 'bottom',
      reset: true
    });
  });
window.themeSwitcher = function () {
    return {
        switchOn: JSON.parse(localStorage.getItem('isDark')) || false,
        switchTheme() {
            if (this.switchOn) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
            localStorage.setItem('isDark', this.switchOn)
        }
    }
}
