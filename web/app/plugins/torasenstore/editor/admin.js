import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';
import VariationGalleryInput from "./components/VariationGalleryInput";

import '../css/main.css'

function configureGalleryComponents()
{
	const buttons = document.querySelectorAll('.woocommerce_variations .upload_image_button');
	buttons.forEach(button => {
		const variationId = parseInt(button.getAttribute('rel'));
		const element = document.createElement('div');
		button.insertAdjacentElement('afterend', element);

		createRoot(element).render(
			<VariationGalleryInput variationId={variationId} />
		);
	});
}

domReady(() => {
	// after variations load
	jQuery( '#woocommerce-product-data' ).on( 'woocommerce_variations_loaded', configureGalleryComponents );

	// Once a new variation is added
	jQuery( '#variable_product_options' ).on( 'woocommerce_variations_added', configureGalleryComponents );
});
