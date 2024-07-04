import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import Column from "./Column";

export default function Edit() {
	return (
		<div { ...useBlockProps() }>
        	<div className="flex flex-wrap justify-end gap-md mt-2xl | md:flex-nowrap | lg:mt-[calc(var(--wp--preset--spacing--xxl)*2)]">
				<Column />
				<Column />
				<Column />
			</div>
		</div>
	);
}
