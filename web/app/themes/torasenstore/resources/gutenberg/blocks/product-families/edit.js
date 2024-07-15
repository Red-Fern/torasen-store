import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Edit( {
	attributes: {
		title
	},
	setAttributes
} ) {
	const blockProps = useBlockProps();
	
	return (
		<div { ...blockProps }>
			<RichText
				tagName='h2'
				value={title}
				allowedFormats={['core/bold', 'core/italic']}
				onChange={(value) => setAttributes({ title: value })}
			/>
		</div>
	);
}
