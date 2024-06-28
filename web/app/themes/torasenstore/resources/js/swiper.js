import Swiper from 'swiper';
import { Navigation, Autoplay } from 'swiper/modules';
import 'swiper/css';

// Build swipers

let defaults = {
    modules: [Navigation, Autoplay],
    slidesPerView: 1,
    spaceBetween: 20,
    speed: 950,
    freeMode: false,
    resistanceRatio: 0,
    centeredSlides: false
};

initSwipers(defaults);

function initSwipers(defaults = {}, selector = ".swiper") {
    let swipers = document.querySelectorAll(selector);

    swipers.forEach((swiperElement) => {
        let optionsData = swiperElement.dataset.swiper ? JSON.parse(swiperElement.dataset.swiper) : {};
        let options = { ...defaults, ...optionsData };

        // If swiper has 'mobile-only' class, handle it using the handleMobileOnlySwiper function
        if (swiperElement.classList.contains('mobile-only')) {
            handleMobileOnlySwipers(swiperElement, options);
        } else {
            new Swiper(swiperElement, options);
        }
    });

    // Handle mobile-only swipers
    function handleMobileOnlySwipers(swiperElement, options) {
        let swiperInstance;

        function toggleSwiper() {
            if (window.innerWidth < 782) {
                if (!swiperInstance) {
                    swiperInstance = new Swiper(swiperElement, options);
                }
            } else {
                if (swiperInstance) {
                    swiperInstance.destroy(false);
                    swiperInstance = undefined;
                }
            }
        }

        toggleSwiper();

        window.addEventListener('resize', toggleSwiper);
    }
}

// Size swipers with bleeding edges

sizeSwipers();

window.addEventListener('resize', sizeSwipers);

function sizeSwipers() {
    let swipers = document.querySelectorAll('.swiper.right-bleed');
    
    swipers.forEach((swiper) => {
        if (swiper.classList.contains('swiper-initialized')) {
            let initialWidth = swiper.offsetWidth,
                rightOffset = window.innerWidth - swiper.getBoundingClientRect().right,
                newWidth = initialWidth + rightOffset + 'px';
            
            swiper.style.width = newWidth;
        }
    });
}
