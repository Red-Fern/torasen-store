import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit() {
	return (
		<p { ...useBlockProps() }>
			{ __( 'Variation Gallery – hello from the editor!', 'variation-gallery' ) }
		</p>
	);
}
