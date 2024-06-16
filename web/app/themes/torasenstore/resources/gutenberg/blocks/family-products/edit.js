import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import ServerSideRender from '@wordpress/server-side-render';

export default function Edit( {
  attributes: {
	  family
  },
  setAttributes
} ) {
	const blockProps = useBlockProps();

	const families = useSelect((select) => {
		const options = select('core').getEntityRecords('taxonomy', 'productfamily', {per_page: 100})
		return options ? options.map(family => {
			return {label: family.name, value: family.id}
		}) : [];
	}, [])

	const familyOptions = [
		{label: '- Inherit from Product -', value: ''},
		...families
	]

	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody title="Settings">
					<SelectControl
						label="Family"
						value={family}
						options={familyOptions}
						onChange={(value) => setAttributes({ family: value })}
					/>
				</PanelBody>
			</InspectorControls>
			<ServerSideRender
				block="torasen/family-products"
				attributes={{
					family: family
				}}
			/>
		</div>
	);
}
