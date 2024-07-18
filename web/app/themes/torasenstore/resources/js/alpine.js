import Alpine from 'alpinejs';

import menu from './alpine/menu';
import menuDropdown from "./alpine/menuDropdown";
import offCanvasModal from "./alpine/offCanvasModal";
import searchModal from "./alpine/searchModal";
import productFilter from "./alpine/productFilter";

window.Alpine = Alpine;

Alpine.data('menu', menu);
Alpine.data('menuDropdown', menuDropdown);
Alpine.data('offCanvasModal', offCanvasModal);
Alpine.data('searchModal', searchModal);
Alpine.data('productFilter', productFilter);

Alpine.start();