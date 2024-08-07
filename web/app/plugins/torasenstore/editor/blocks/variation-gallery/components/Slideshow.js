import { useEffect, useRef } from "@wordpress/element";
import { useSelect } from '@wordpress/data';
import { useInView } from "react-intersection-observer";
import {ATTRIBUTE_STORE_NAME} from "../../../stores/constants";

export default function Slideshow({ videoUrl }) {
	const swiperElRef = useRef(null);
	const videoElRef = useRef(null);

	const variation = useSelect((select) => select(ATTRIBUTE_STORE_NAME).getVariation());
	const imageCount = variation?.galleryImages?.length;
	const { ref, inView, entry } = useInView({
		threshold: 0,
	})

	const videoIndex = videoUrl ? imageCount + 1 : null;

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

	useEffect(() => {
		if (!videoElRef.current) {
			return;
		}

		if (inView) {
			videoElRef.current.play();
		} else {
			videoElRef.current.pause();
		}
	}, [inView]);

	const nextSlide = () => {
		swiperElRef.current.swiper.slideNext();
	}

	const prevSlide = () => {
		swiperElRef.current.swiper.slidePrev();
	}

	const goToVideo = (e) => {
		e.preventDefault();

		if (!videoIndex) {
			return;
		}

		swiperElRef.current.swiper.slideTo(videoIndex);
		videoElRef.current.play();
	}

	return (
		<div className="relative">
			<div className="absolute z-[5] top-0 right-0 p-8 flex items-center gap-5">
				{videoUrl && (
					<button
						type="button"
						className="flex gap-3 items-center bg-white px-5 py-2 h-10 hover:bg-gray-50"
						onClick={goToVideo}
					>
						<span>Video</span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
							<path d="M2.60156 14.4156L1.60156 15V13.8438V2.15625V1L2.60156 1.58438L12.6078 7.42188L13.6016 8L12.6078 8.57812L2.60156 14.4156ZM11.6172 8L2.60156 2.74062V13.2594L11.6172 8Z" fill="currentColor"/>
						</svg>
					</button>
				)}

				{imageCount > 2 && (
					<div className="flex divide-x divide-gray-200">
						<button type="button"
								className="bg-white grid place-items-center w-10 h-10 hover:bg-gray-50"
								onClick={prevSlide}
						>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
								<path d="M1.15391 7.64683L0.800781 7.99995L1.15391 8.35308L6.40391 13.6031L6.75703 13.9562L7.46328 13.25L7.11016 12.8968L2.71328 8.49995H14.257H14.757V7.49995H14.257H2.71328L7.11016 3.10308L7.46328 2.74995L6.75703 2.0437L6.40391 2.39683L1.15391 7.64683Z" fill="currentColor"/>
							</svg>
						</button>
						<button
							type="button"
							className="bg-white grid place-items-center w-10 h-10 hover:bg-gray-50"
							onClick={nextSlide}
						>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
								<path d="M14.4039 8.35308L14.757 7.99995L14.4039 7.64683L9.15391 2.39683L8.80078 2.0437L8.09453 2.74995L8.44766 3.10308L12.8445 7.49995H1.30078H0.800781V8.49995H1.30078H12.8445L8.44766 12.8968L8.09453 13.25L8.80078 13.9562L9.15391 13.6031L14.4039 8.35308Z" fill="currentColor"/>
							</svg>
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
						class="!h-auto [&:not(:first-child)]:border-l border-[#D0D0CD] has-lightest-grey-background-color overflow-hidden"
						key={mediaItem.id}
					>
						<img class="scale-125 -translate-y-10 mix-blend-multiply" src={mediaItem.url} alt={mediaItem.alt} key={mediaItem.id}/>
					</swiper-slide>
				))}

				{videoUrl && (
					<swiper-slide
						class="!h-auto [&:not(:first-child)]:border-l border-[#D0D0CD] has-lightest-grey-background-color"
						key={videoUrl}
						ref={ref}
					>
						<video ref={videoElRef} className="w-full h-full object-cover" controls={false} autoPlay={true} loop={true}>
							<source src={videoUrl} type="video/mp4"/>
						</video>
					</swiper-slide>
				)}
			</swiper-container>
		</div>
	)
}
