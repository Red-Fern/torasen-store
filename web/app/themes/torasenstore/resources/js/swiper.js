import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';

document.querySelectorAll('.swiper-container').forEach((el) => {
    // Get carousel, arrows and data attributes
    let carousel = el.querySelector('.swiper'),
        prevArrow = el.querySelector('.swiper-button-prev'),
        nextArrow = el.querySelector('.swiper-button-next'),
        noSlides = carousel.dataset.slides ?? 1,
        noSlidesSm = carousel.dataset.slidesSm ?? noSlides,
        noSlidesMd = carousel.dataset.slidesMd ?? noSlides,
        noSlidesLg= carousel.dataset.slidesLg ?? noSlides,
        slidesGap = carousel.dataset.slidesGap ?? 20;

    new Swiper(carousel, {
        modules: [Navigation, Pagination],
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
})