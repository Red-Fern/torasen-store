import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import ProductItem from "./ProductItem";

export default function Edit() {
	return (
		<div { ...useBlockProps() }>
			<div className="grid grid-cols-2 gap-xs | lg:grid-cols-4">
				<ProductItem />
				<ProductItem />
				<ProductItem />
				<ProductItem />
			</div>
		</div>
	);
}
