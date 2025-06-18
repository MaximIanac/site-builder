import './bootstrap.js';
import useAjax from "./composables/useAjax.js";

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.useAjax = useAjax;

Alpine.start()
