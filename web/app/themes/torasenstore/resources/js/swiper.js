import Swiper from 'swiper';
import 'swiper/css';

(function () {
    let carouselElements = document.querySelectorAll('.swiper-container');

    function initCarousels() {
        for (let i = 0; i < carouselElements.length; i++) {
            // Get carousel, arrows and data attributes
            let carousel = carouselElements[i].querySelector('.swiper'),
                prevArrow = carouselElements[i].querySelector('.swiper-button-prev'),
                nextArrow = carouselElements[i].querySelector('.swiper-button-next'),
                noSlides = carousel.dataset.slides ?? 1,
                noSlidesSm = carousel.dataset.slidesSm ?? noSlides,
                noSlidesMd = carousel.dataset.slidesMd ?? noSlides,
                noSlidesLg= carousel.dataset.slidesLg ?? noSlides,
                slidesGap = carousel.dataset.slidesGap ?? 20;

            new Swiper(carousel, {
                navigation: {
                    prevEl: prevArrow,
                    nextEl: nextArrow
                },
                slidesPerView: noSlides,
                spaceBetween: slidesGap,
                breakpoints: {
                    640: {
                        slidesPerView: noSlidesSm
                    },
                    768: {
                        slidesPerView: noSlidesMd
                    },
                    1024: {
                        slidesPerView: noSlidesLg
                    }
                }
            });
        }
    }

    domReady(function () {
        if (!document.body) {
            return;
        } else {
            if (carouselElements) {
                initCarousels();
            }
        }
    });
});