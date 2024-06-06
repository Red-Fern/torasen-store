import { useBlockProps, InspectorControls, useInnerBlocksProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit({
	attributes: {
		activeTab
	},
	setAttributes
}) {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps(blockProps);

	return (
		<>
			<InspectorControls>
				<PanelBody title="Accordion Item Settings">
					<TextControl
						label="Active Tab"
						value={activeTab}
						onChange={(value) => setAttributes({ activeTab: value })}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...innerBlocksProps} />
		</>
	);
}
