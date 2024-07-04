import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';
import ProductInformation from "./components/ProductInformation";

domReady(() => {
	const container = document.querySelector('#torasen-product-price');

	const root = createRoot(container)
	root.render(
		<ProductInformation productId={container.dataset.productId}/>,
	)
});
