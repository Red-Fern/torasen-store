import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';

export default function Edit({
	attributes: {
		label
	},
	setAttributes,
	isSelected,
	clientId
}) {
	const isAccordionOpen = useSelect((select) => {
		return select( 'core/block-editor' ).hasSelectedInnerBlock(clientId, true)
	}) || isSelected;

	const blockProps = useBlockProps();
	
	return (
		<div { ...blockProps }>
			<RichText
				tagName="div"
				value={label}
				allowedFormats={['core/bold', 'core/italic']}
				onChange={(value) => setAttributes({ label: value })}
				placeholder={__( 'Accordion Label', 'accordion-item' )}
				className="accordion-item__label"
			/>
			<div
				className="accordion-item__content"
				hidden={!isAccordionOpen}
			>
				<InnerBlocks/>
			</div>
		</div>
	);
}
