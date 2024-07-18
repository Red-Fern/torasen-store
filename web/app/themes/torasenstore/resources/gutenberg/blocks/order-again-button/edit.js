import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	return (
		<div { ...useBlockProps() }>
			<p className="order-again">
				<a href="#" className="button wp-element-button">Order again</a>
			</p>
		</div>
	);
}

