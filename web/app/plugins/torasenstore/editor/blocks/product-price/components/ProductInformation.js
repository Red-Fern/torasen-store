import { ATTRIBUTE_STORE_NAME, EXTRA_STORE_NAME } from "../../../stores/constants";
import { useSelect } from '@wordpress/data';

export default function ProductInformation({ productId }) {
	const variation = useSelect((select) => {
		return select(ATTRIBUTE_STORE_NAME).getVariation();
	}, [productId]);

	return (
		<div className="text-xl font-bold flex justify-between">
			<div className="flex gap-2">
				<span>SKU:</span>
				<div>{variation.sku}</div>
			</div>
			<div>
				<span dangerouslySetInnerHTML={{ __html: variation.price_html }}></span>
			</div>
		</div>
	)
}
