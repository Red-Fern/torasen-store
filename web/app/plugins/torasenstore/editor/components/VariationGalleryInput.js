import { useState, useEffect, useRef } from '@wordpress/element';
import { Button } from '@wordpress/components';
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import VariationGalleryItem from "./VariationGalleryItem";
import Sortable from "./Sortable";
import {SortableItem} from "./SortableItem";

const ALLOWED_MEDIA_TYPES = [ 'image' ];

export default function VariationGalleryInput({ variationId }) {
	const inputRef = useRef(null);
	const inputName = `variation_media_gallery[${variationId}]`
	const [selectedMedia, setSelectedMedia] = useState([]);
	const mediaIds = selectedMedia.map(media => media.id);

	const selectMedia = (media) => {
		setSelectedMedia([...selectedMedia, ...media]);
		triggerInputChanged()
	}

	const updateMediaOrder = (newOrder) => {
		setSelectedMedia(newOrder);
		triggerInputChanged()
	};

	const removeMedia = (mediaId) => {
		setSelectedMedia(selectedMedia.filter(media => media.id !== mediaId));
		triggerInputChanged()
	}

	const triggerInputChanged = () => {
		jQuery(inputRef.current)
			.closest( '.woocommerce_variation' )
			.addClass( 'variation-needs-update' );

		jQuery( 'button.cancel-variation-changes, button.save-variation-changes' ).removeAttr( 'disabled' );

		jQuery( '#variable_product_options' ).trigger( 'woocommerce_variations_input_changed' );
	}

	useEffect(() => {
		const fetchGalleryMedia = async () => {
			const response = await fetch(`/wp-json/torasen/v1/variation-gallery/${variationId}`);
			const { images } = await response.json();
			setSelectedMedia(images);
		}

		fetchGalleryMedia();
	}, []);

	return (
		<div ref={inputRef} className="clear-both mt-2">
			<MediaUploadCheck>
				<div className="bg-gray-200 w-full p-3 border border-gray-400">
					<div className="w-full flex gap-2 mb-2">
						<Sortable items={selectedMedia} onSort={updateMediaOrder}>
							{selectedMedia.map(media => (
								<SortableItem key={media.id} id={media.id}>
									<VariationGalleryItem
										key={media.id}
										media={media}
										removeMedia={removeMedia}
									/>
								</SortableItem>
							))}
						</Sortable>
					</div>

					<MediaUpload
						onSelect={(media) => {
							selectMedia(media)
						}}
						allowedTypes={ALLOWED_MEDIA_TYPES}
						multiple
						value={selectedMedia}
						render={({open}) => (
							<Button
								className="bg-black text-white w-8 h-8 grid place-items-center text-lg font-bold p-0"
								onClick={open}>+</Button>
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

