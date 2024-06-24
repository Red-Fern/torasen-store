import { useState, useEffect } from '@wordpress/element';

export default function ProductAttributes({
	productId
}) {
	const [productAttributes, setProductAttributes] = useState([]);

	useEffect(() => {
		loadProductAttributes();
	}, [])

	async function loadProductAttributes() {
		const response = await fetch(`https://torasen-essentials.test/wp-json/torasen/v1/attributes/${productId}`);
		const data = await response.json();

		setProductAttributes(data.attributes);
	}

	return (
		<div>
			{'Product Attributes – hello from the editor!'}
		</div>
	)
}
