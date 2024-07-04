import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

import './editor.scss';

export default function Edit(props) {

	return (
		<div { ...useBlockProps({
			className: 'flex justify-between'
		}) }>
			<div>SKU: Product SKU</div>
			<div>£50.00</div>
		</div>
	);
}
