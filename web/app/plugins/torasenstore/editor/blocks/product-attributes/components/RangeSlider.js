import { useRef, useEffect } from '@wordpress/element';
import RangeProduct from "./RangeProduct";

export default function RangeSlider({ products }) {
	const swiperElRef = useRef(null);

	const swiperParams = {
		slidesPerView: 1.2,
		spaceBetween: 20,
		breakpoints: {
			640: {
				slidesPerView: 3.5,
			},
			768: {
				slidesPerView: 4.5,
			},
		},
		freeMode: true,
		mousewheel: {
			forceToAxis: true,
		}
	};

	useEffect(() => {
		Object.assign(swiperElRef.current, swiperParams);

		swiperElRef.current.initialize();
	}, []);

	const nextSlide = () => {
		swiperElRef.current.swiper.slideNext();
	}

	const prevSlide = () => {
		swiperElRef.current.swiper.slidePrev();
	}

	return (
		<div className="overflow-hidden my-4">
			<swiper-container
				init="false"
				ref={swiperElRef}
			>
				{products.map((product) => (
					<swiper-slide
						className="!h-auto p-6"
						key={product.id}
					>
						<RangeProduct key={product.id} product={product}/>
					</swiper-slide>
				))}
			</swiper-container>
		</div>
	)
}
