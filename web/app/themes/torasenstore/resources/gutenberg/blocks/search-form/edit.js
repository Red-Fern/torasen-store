import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	return (
		<div { ...useBlockProps() }>
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
				<path fill="currentColor" d="M12 6.5a5.5 5.5 0 1 0-11 0 5.5 5.5 0 0 0 11 0Zm-1.272 4.938A6.464 6.464 0 0 1 6.5 13C2.91 13 0 10.09 0 6.5S2.91 0 6.5 0 13 2.91 13 6.5a6.464 6.464 0 0 1-1.563 4.228l4.516 4.519-.706.706-4.519-4.515Z"/>
			</svg>
		</div>
	);
}

