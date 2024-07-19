import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit({
	attributes: {
		filterId
	},
	setAttributes
}) {
	return (
		<div { ...useBlockProps() }>
			Collection Logo
		</div>
	);
}

