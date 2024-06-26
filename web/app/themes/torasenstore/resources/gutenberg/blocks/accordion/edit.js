import { useBlockProps, InspectorControls, useInnerBlocksProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';

const TEMPLATE = [
	[ 'red-fern/accordion-item', { label: "Accordion 1" } ],
	[ 'red-fern/accordion-item', { label: "Accordion 2" } ],
];

export default function Edit({
	attributes: {
		theme,
		activeTab
	},
	setAttributes,
	clientId
}) {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps(
		blockProps,
		{
			template: TEMPLATE,
			templateLock: false
		}
	);

	const innerBlocks = useSelect((select) => {
		return select('core/block-editor').getBlock(clientId).innerBlocks;
	})

	const themeOptions = [
		{
			value: 'faqs',
			label: 'FAQs'
		},
		{
			value: 'panels',
			label: 'Panels'
		}
	];

	const tabOptions = [
		{
			value: '',
			label: '- None Selected -'
		}
	];

	innerBlocks?.filter(block => {
		return !! block.attributes.slug
	}).map((block, index) => {
		tabOptions.push({
			value: block.attributes.slug,
			label: block.attributes.label
		})
	})

	return (
		<>
			<InspectorControls>
				<PanelBody title="Accordion Item Settings">
					<SelectControl
						label="Theme"
						value={theme}
						options={themeOptions}
						onChange={(value) => setAttributes({ theme: value })}
					/>
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
