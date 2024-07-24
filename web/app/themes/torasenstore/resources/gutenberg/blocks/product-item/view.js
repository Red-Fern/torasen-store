/**
 * WordPress dependencies
 */
import { store, getContext } from "@wordpress/interactivity";

store( 'product-item', {
	actions: {
		changeImage: (e) => {
			const context = getContext();

			const src = e.srcElement.getAttribute('src');
			const srcSet = e.srcElement.getAttribute('srcset');

			context.imageUrl = src;
			context.srcSet = srcSet;
		},
		revertImage: (e) => {
			const context = getContext();
			context.imageUrl = context.originalImageUrl;
			context.srcSet = context.originalSrcSet;
		}
	},
	callbacks: {
		cacheImage: () => {
			const { imageUrl, srcSet } = getContext();

		},
	},
} );

