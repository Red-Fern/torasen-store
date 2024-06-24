import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit({ context }) {
	return (
		<div { ...useBlockProps() }>
			{ __( 'Product Attributes – hello from the editor!', 'product-attributes' ) }
		</div>
	);
}
