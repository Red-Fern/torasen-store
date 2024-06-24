import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';

export default function Edit({
	attributes: {
		label,
		slug
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
			<InspectorControls>
				<PanelBody title={ __( 'Accordion Item Settings', 'accordion-item' ) }>
					<TextControl
						label={ __( 'Slug', 'red-fern' ) }
						value={ slug }
						onChange={(value) => setAttributes({ slug: value })}
						help={ __( 'Unique identifier for accordion item to allow setting as active tab.', 'red-fern' )}
					/>
				</PanelBody>
			</InspectorControls>
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
