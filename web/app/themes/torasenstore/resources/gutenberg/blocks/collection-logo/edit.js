import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	return (
		<div { ...useBlockProps() }>
			<div className="w-[104px] h-[33px] bg-light-grey | lg:w-[208px] lg:h-[66px]"></div>
		</div>
	);
}
