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
			const productName = e.srcElement.getAttribute('data-product-name');

			context.imageUrl = src;
			context.srcSet = srcSet;
			context.productName = productName;
		},
		revertImage: (e) => {
			const context = getContext();
			context.imageUrl = context.originalImageUrl;
			context.srcSet = context.originalSrcSet;
			context.productName = context.originalProductName;
		}
	},
	callbacks: {
		cacheImage: () => {
			const { imageUrl, srcSet } = getContext();

		},
	},
} );

