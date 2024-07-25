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
			<div className="absolute z-20 top-0 right-0 px-8 py-8 flex items-center gap-4">
				{videoUrl && (
					<button
						type="button"
						className="flex gap-2 items-center bg-white p-3 hover:bg-[#D0D0CD] shadow"
						onClick={goToVideo}
					>
						<span className="text-sm">Video</span>
						<svg className="w-4 h-4 text-[#1D1D1B]" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path d="M2.60156 14.4156L1.60156 15V13.8438V2.15625V1L2.60156 1.58438L12.6078 7.42188L13.6016 8L12.6078 8.57812L2.60156 14.4156ZM11.6172 8L2.60156 2.74062V13.2594L11.6172 8Z"/>
						</svg>
					</button>
				)}

				{imageCount > 3 && (
					<div className="flex divide-x divide-[#D0D0CD]">
						<button type="button"
								className="bg-white grid place-items-center p-3 hover:bg-[#D0D0CD] shadow "
								onClick={prevSlide}
						>
							<svg className="w-4 h-4 text-[#1D1D1B]" viewBox="0 0 16 16" fill="currentColor"
								 xmlns="http://www.w3.org/2000/svg">
								<path d="M1.15391 7.64683L0.800781 7.99995L1.15391 8.35308L6.40391 13.6031L6.75703 13.9562L7.46328 13.25L7.11016 12.8968L2.71328 8.49995H14.257H14.757V7.49995H14.257H2.71328L7.11016 3.10308L7.46328 2.74995L6.75703 2.0437L6.40391 2.39683L1.15391 7.64683Z"/>
							</svg>
						</button>
						<button
							type="button"
							className="bg-white grid place-items-center p-3 hover:bg-[#D0D0CD] shadow"
							onClick={nextSlide}
						>
							<svg className="w-4 h-4 text-[#1D1D1B]" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.4039 8.35308L14.757 7.99995L14.4039 7.64683L9.15391 2.39683L8.80078 2.0437L8.09453 2.74995L8.44766 3.10308L12.8445 7.49995H1.30078H0.800781V8.49995H1.30078H12.8445L8.44766 12.8968L8.09453 13.25L8.80078 13.9562L9.15391 13.6031L14.4039 8.35308Z"/>
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
						class="!h-auto [&:not(:first-child)]:border-l border-[#D0D0CD] has-lightest-grey-background-color"
						key={mediaItem.id}
					>
						<img class="mix-blend-multiply" src={mediaItem.url} alt={mediaItem.alt} key={mediaItem.id}/>
					</swiper-slide>
				))}

				{videoUrl && (
					<swiper-slide
						class="!h-auto [&:not(:first-child)]:border-l border-[#D0D0CD] has-lightest-grey-background-color"
						key={videoUrl}
						ref={ref}
					>
						<video ref={videoElRef} controls={false} autoPlay={true} loop={true}>
							<source src={videoUrl} type="video/mp4"/>
						</video>
					</swiper-slide>
				)}
			</swiper-container>
		</div>
	)
}
