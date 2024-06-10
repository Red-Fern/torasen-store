import { useBlockProps, InspectorControls, useInnerBlocksProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';

export default function Edit({
	attributes: {
		activeTab
	},
	setAttributes,
	clientId
}) {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps(blockProps);

	const innerBlocks = useSelect((select) => {
		return select('core/block-editor').getBlock(clientId).innerBlocks;
	})

	const tabOptions = [
		{
			value: '',
			label: '- None Selected -'
		}
	];
	innerBlocks?.map((block, index) => {
		tabOptions.push({
			value: block.clientId,
			label: block.attributes.label
		})
	})

	return (
		<>
			<InspectorControls>
				<PanelBody title="Accordion Item Settings">
					<SelectControl
						label="Active Tab"
						value={activeTab}
						options={tabOptions}
						onChange={(value) => setAttributes({ activeTab: value })}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...innerBlocksProps} />
		</>
	);
}
