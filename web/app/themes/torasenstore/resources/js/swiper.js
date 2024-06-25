import Swiper from 'swiper/bundle';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';

let defaults = {
    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: 1,
    spaceBetween: 0,
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