import Swiper from 'swiper/bundle';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';

// Build swipers

let defaults = {
    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: 1,
    spaceBetween: 20,
    speed: 950
};

initSwipers(defaults);

function initSwipers(defaults = {}, selector = ".swiper") {
    let swipers = document.querySelectorAll(selector);
    
    swipers.forEach((swiper) => {
        let optionsData = swiper.dataset.swiper ? JSON.parse(swiper.dataset.swiper) : {};

        let options = {
            ...defaults,
            ...optionsData
        };

        new Swiper(swiper, options);
    });
}

// Size swipers with bleeding edges

sizeSwipers();

window.addEventListener('resize', function() {
    sizeSwipers();
}, true);

function sizeSwipers() {
    let swipers = document.querySelectorAll('.swiper.right-bleed');
    
    swipers.forEach((swiper) => {
        let initialWidth = swiper.offsetWidth,
            rightOffset = window.innerWidth - swiper.getBoundingClientRect().right,
            newWidth = initialWidth + rightOffset + 'px';
        
        swiper.style.width = newWidth;
    });
}