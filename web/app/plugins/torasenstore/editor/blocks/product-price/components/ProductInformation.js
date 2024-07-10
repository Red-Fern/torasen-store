import { ATTRIBUTE_STORE_NAME, EXTRA_STORE_NAME } from "../../../stores/constants";
import { useSelect } from '@wordpress/data';

export default function ProductInformation({ productId }) {
	const variation = useSelect((select) => {
		return select(ATTRIBUTE_STORE_NAME).getVariation();
	}, [productId]);

	const extraPrices = useSelect((select) => {
		return select(EXTRA_STORE_NAME).getSelectedPrices();
	}, [productId]);

	const price = variation ? variation.display_price + extraPrices : 0;
	const priceFormatter = new Intl.NumberFormat('en-US', {
		style: 'currency',
		currency: 'GBP',
	});

	return (
		<div className="text-xl font-bold flex justify-between">
			<div className="flex gap-2">
				<span>SKU:</span>
				<div>{variation.sku}</div>
			</div>
			<div>
				<span>{priceFormatter.format(price)}</span>
			</div>
		</div>
	)
}
