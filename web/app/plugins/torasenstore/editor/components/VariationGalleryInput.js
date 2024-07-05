import { useState } from '@wordpress/element';
import { Button } from '@wordpress/components';
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import VariationGalleryItem from "./VariationGalleryItem";

const ALLOWED_MEDIA_TYPES = [ 'image' ];

export default function VariationGalleryInput({ variationId }) {
	const inputName = `variation_media_gallery[${variationId}]`

	const [selectedMedia, setSelectedMedia] = useState([]);

	const mediaIds = selectedMedia.map(media => media.id);

	const removeMedia = (mediaId) => {
		setSelectedMedia(selectedMedia.filter(media => media.id !== mediaId));
	}

	return (
		<div className="clear-both mt-2">

			<MediaUploadCheck>
				<div className="bg-gray-200 w-full p-3 border border-gray-400">
					<div className="w-full flex gap-2 mb-2">
						{selectedMedia.map(media => (
							<VariationGalleryItem
								key={media.id}
								media={media}
								removeMedia={removeMedia}
							/>
						))}
					</div>
					<MediaUpload
						onSelect={(media) => {
							// append array of media onto existing media array
							setSelectedMedia([...selectedMedia, ...media]);
						}}
						allowedTypes={ALLOWED_MEDIA_TYPES}
						multiple
						value={selectedMedia}
						render={({open}) => (
							<Button className="bg-black text-white w-8 h-8 grid place-items-center text-lg font-bold p-0" onClick={open}>+</Button>
						)}
					/>
				</div>
			</MediaUploadCheck>
			<input
				type="hidden"
				className="torasen-variation-gallery-input"
				name={inputName}
				value={mediaIds.join(',')}
			/>
		</div>
	);
}

