import { useEffect, useRef } from "@wordpress/element";
import { useSelect } from '@wordpress/data';
import {ATTRIBUTE_STORE_NAME} from "../../../stores/constants";

export default function VariationGallery({}) {
	const swiperElRef = useRef(null);
	const variation = useSelect((select) => select(ATTRIBUTE_STORE_NAME).getVariation());

	const swiperParams = {
		slidesPerView: 1.2,
		spaceBetween: 20,
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

	return (
		<swiper-container
			init="false"
			ref={swiperElRef}
		>
			{variation?.galleryImages?.map((mediaItem) => (
				<swiper-slide key={mediaItem.id}>
					<img src={mediaItem.url} alt={mediaItem.alt} key={mediaItem.id}/>
				</swiper-slide>
			))}
		</swiper-container>
	)
}
