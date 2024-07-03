import { useState, useEffect } from '@wordpress/element';
import { useSelect, useDispatch } from '@wordpress/data';
import { store as attributeStore } from '../store';
import { store as extrasStore } from '../store/extras';
import Attribute from "./Attribute";
import ExtraField from "./ExtraField";

export default function ProductAttributes({
	productId
}) {
	const productAttributes = useSelect((select) => {
		return select(attributeStore).getAttributes(productId);
	}, [productId]);

	const extras = useSelect((select) => {
		return select(extrasStore).getFields(productId);
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


				{Object.entries(extras).map(([fieldId, field]) => (
					<ExtraField key={fieldId} field={field} />
				))}
			</div>
		</>
	)
}
