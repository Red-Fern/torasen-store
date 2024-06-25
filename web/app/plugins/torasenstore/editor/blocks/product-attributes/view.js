import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';
import ProductAttributes from "./components/ProductAttributes";

domReady(() => {
	const container = document.querySelector('#torasen-product-form');

	const root = createRoot(container)
	root.render(
		<ProductAttributes productId={container.dataset.productId}/>,
	)
});
