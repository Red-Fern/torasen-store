import { useState, useEffect } from '@wordpress/element';
import { useSelect, useDispatch } from '@wordpress/data';
import { ATTRIBUTE_STORE_NAME, EXTRA_STORE_NAME } from '../../../stores/constants';
import Attribute from "./Attribute";
import ExtraField from "./ExtraField";
import RangeProducts from "./RangeProducts";

export default function ProductAttributes({
	productId
}) {
	const productAttributes = useSelect((select) => {
		return select(ATTRIBUTE_STORE_NAME).getAttributes(productId);
	}, [productId]);

	const extras = useSelect((select) => {
		return select(EXTRA_STORE_NAME).getFields(productId);
	}, [productId]);

	const variation = useSelect((select) => select(ATTRIBUTE_STORE_NAME).getVariation());

	useEffect(() => {
		document.querySelector('input[name="variation_id"]').value = variation ? variation.variation_id : '';
	}, [variation])

	return (
		<>
			<div className="flex flex-col gap-4">
				<RangeProducts productId={productId} />

				{Object.entries(productAttributes).map(([attributeSlug, attribute]) => (
					<Attribute key={attributeSlug} attribute={attribute}/>
				))}

				{extras && Object.entries(extras).map(([fieldId, field]) => (
					<ExtraField key={fieldId} field={field} />
				))}
			</div>
		</>
	)
}
