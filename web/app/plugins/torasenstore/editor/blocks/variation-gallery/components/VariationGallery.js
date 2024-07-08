import { useSelect } from '@wordpress/data';
import {ATTRIBUTE_STORE_NAME} from "../../../stores/constants";
import Slideshow from "./Slideshow";

export default function VariationGallery({ videoUrl }) {
	const variation = useSelect((select) => select(ATTRIBUTE_STORE_NAME).getVariation());
	const imageCount = variation?.galleryImages?.length;

	return imageCount > 0 ? <Slideshow videoUrl={videoUrl}/> : (
		<div>No Images Found</div>
	)
}
