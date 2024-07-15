import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import ProductItem from "./ProductItem";

export default function Edit( {
	attributes: {
		title
	},
	setAttributes
} ) {
	return (
		<div { ...useBlockProps() }>
			<div className="flex flex-wrap gap-md | lg:flex-nowrap">
				<RichText
					tagName='h2'
					value={title}
					allowedFormats={['core/bold', 'core/italic']}
					onChange={(value) => setAttributes({ title: value })}
				/>
			</div>

			<div className="grid grid-cols-2 gap-xs mt-sm | lg:grid-cols-4">
				<ProductItem />
				<ProductItem />
				<ProductItem />
				<ProductItem />
			</div>
		</div>
	);
}
