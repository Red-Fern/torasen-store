import Alpine from 'alpinejs';

import menu from './alpine/menu';
import menuDropdown from "./alpine/menuDropdown";
import offCanvasModal from "./alpine/offCanvasModal";

window.Alpine = Alpine;

Alpine.data('menu', menu);
Alpine.data('menuDropdown', menuDropdown);
Alpine.data('offCanvasModal', offCanvasModal);

Alpine.start();