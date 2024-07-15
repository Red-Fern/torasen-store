import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit({ context }) {
	return (
		<div { ...useBlockProps() }>
			<div className="flex flex-col gap-lg">
				<div className="border-b border-gray-300"></div>
				<div className="border-b border-gray-300"></div>
				<div className="border-b border-gray-300"></div>
				<div className="border-b border-gray-300"></div>
			</div>
		</div>
	);
}
