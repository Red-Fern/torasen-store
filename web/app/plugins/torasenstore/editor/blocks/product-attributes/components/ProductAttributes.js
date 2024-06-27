import { useState, useEffect } from '@wordpress/element';
import { useSelect, useDispatch } from '@wordpress/data';
import { store as attributeStore } from '../store';
import Attribute from "./Attribute";

export default function ProductAttributes({
	productId
}) {
	const productAttributes = useSelect((select) => {
		return select(attributeStore).getAttributes(productId);
	}, [productId]);

	const variation = useSelect((select) => select(attributeStore).getVariation());

	useEffect(() => {
		document.querySelector('input[name="variation_id"]').value = variation ? variation.variation_id : '';
	}, [variation])

	return (
		<>
			<div className="flex flex-col gap-4">
				{Object.entries(productAttributes).map(([attributeSlug, attribute]) => (
					<Attribute key={attributeSlug} attribute={attribute}/>
				))}
			</div>
		</>
	)
}
