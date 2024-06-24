import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const blockProps = useBlockProps.save();

	return (
		<div { ...blockProps }>
			<div class="flex gap-[5px]">
				<RichText.Content { ...blockProps } value={ attributes.label } />
				<span>{ new Date().getFullYear() }</span>
			</div>
		</div>
	);
}
