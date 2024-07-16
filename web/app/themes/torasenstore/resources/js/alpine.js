import Alpine from 'alpinejs';

import menu from './alpine/menu';
import menuDropdown from "./alpine/menuDropdown";
import offCanvasModal from "./alpine/offCanvasModal";
import searchModal from "./alpine/searchModal";

window.Alpine = Alpine;

Alpine.data('menu', menu);
Alpine.data('menuDropdown', menuDropdown);
Alpine.data('offCanvasModal', offCanvasModal);
Alpine.data('searchModal', searchModal);

Alpine.start();