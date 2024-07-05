import { useEffect, useRef } from "@wordpress/element";
import { useSelect } from '@wordpress/data';
import {ATTRIBUTE_STORE_NAME} from "../../../stores/constants";

export default function Slideshow({}) {
	const swiperElRef = useRef(null);
	const variation = useSelect((select) => select(ATTRIBUTE_STORE_NAME).getVariation());

	const swiperParams = {
		slidesPerView: 1.2,
		breakpoints: {
			640: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 3,
			},
		},
	};

	useEffect(() => {
		Object.assign(swiperElRef.current, swiperParams);

		swiperElRef.current.initialize();
	}, []);

	const nextSlide = () => {
		swiperElRef.current.swiper.slideNext();
		console.log(swiperElRef.current);
	}

	const prevSlide = () => {
		swiperElRef.current.swiper.slidePrev();
	}

	const imageCount = variation?.galleryImages?.length;

	return (
		<div className="relative">
			<div className="absolute z-20 top-0 right-0 px-8 py-8 flex items-center gap-4">
				<button type="button" className="bg-white grid place-items-center p-3 hover:bg-[#D0D0CD]">Video</button>

				{imageCount > 3 && (
					<div className="flex divide-x divide-[#D0D0CD]">
						<button type="button" className="bg-white grid place-items-center p-3 hover:bg-[#D0D0CD]"
								onClick={prevSlide}>Prev
						</button>
						<button type="button" className="bg-white grid place-items-center p-3 hover:bg-[#D0D0CD]"
								onClick={nextSlide}>Next
						</button>
					</div>
				)}
			</div>

			<swiper-container
				init="false"
				ref={swiperElRef}
				class="border-t border-b border-[#D0D0CD]"
			>
				{variation?.galleryImages?.map((mediaItem) => (
					<swiper-slide
						class="!h-auto [&:not(:first-child)]:border-l border-[#D0D0CD] p-6"
						key={mediaItem.id}
					>
						<img src={mediaItem.url} alt={mediaItem.alt} key={mediaItem.id}/>
					</swiper-slide>
				))}
			</swiper-container>
		</div>
	)
}
