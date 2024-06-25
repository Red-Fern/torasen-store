import { useState, useEffect } from '@wordpress/element';
import { useSelect, useDispatch } from '@wordpress/data';
import { store as attributeStore } from '../store';
import Attribute from "./Attribute";

export default function ProductAttributes({
	productId
}) {
	const [productAttributes, setProductAttributes] = useState({});

	const count = useSelect((select) => {
		return select(attributeStore).getCount();
	}, []);

	const { increment } = useDispatch(attributeStore);


	useEffect(() => {
		loadProductAttributes();
	}, [])

	async function loadProductAttributes() {
		const response = await fetch(`https://torasen-essentials.test/wp-json/torasen/v1/attributes/${productId}`);
		const data = await response.json();

		setProductAttributes(data.attributes);
	}

	return (
		<div className="flex flex-col">
			{Object.entries(productAttributes).map(([attributeSlug, attribute]) => (
				<Attribute key={attributeSlug} attribute={attribute} />
			))}
			<div>COUNT = {count}</div>
			<button type="button" onClick={() => increment()}>Increment</button>
			{'Product Attributes – hello from the editor!'}
		</div>
	)
}
