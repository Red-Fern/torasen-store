import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';
import VariationGallery from "./components/VariationGallery";

domReady(() => {
	const container = document.querySelector('#torasen-variation-gallery');

	const root = createRoot(container)
	root.render(
		<VariationGallery
			productId={container.dataset.productId}
			videoUrl={container.dataset.video}
		/>,
	)
});
