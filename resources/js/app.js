import 'foundation-sites/dist/css/foundation.min.css';
import 'foundation-sites';
import './bootstrap';




import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import $ from 'jquery';

window.$ = window.jQuery = $;

$(document).foundation();