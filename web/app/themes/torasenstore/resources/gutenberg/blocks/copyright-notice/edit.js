import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Edit({
	attributes: {
		label,
	},
	setAttributes,
}) {
	const blockProps = useBlockProps();
	
	return (
		<div { ...blockProps }>
			<div className="flex gap-[5px]">
				<RichText
					value={label}
					allowedFormats={['core/bold', 'core/italic']}
					onChange={(value) => setAttributes({ label: value })}
					placeholder={__( 'Copyright notice', 'copyright-notice' )}
				/>
				<span>{ new Date().getFullYear() }</span>
			</div>
		</div>
	);
}
