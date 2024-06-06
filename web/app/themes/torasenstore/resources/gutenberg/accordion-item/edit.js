import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';

export default function Edit({
	attributes: {
		label
	},
	setAttributes
}) {
	const blockProps = useBlockProps();
	
	return (
		<div { ...blockProps }>
			<RichText
				tagName="div"
				value={label}
				allowedFormats={['core/bold', 'core/italic']}
				onChange={(value) => setAttributes({ label: value })}
				placeholder={__( 'Accordion Label', 'accordion-item' )}
			/>
			<div className="accordion-item__content">
				<InnerBlocks/>
			</div>
		</div>
	);
}
