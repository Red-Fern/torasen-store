import { render } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

function onChange(value) {
	console.log(value)
}

export default function AttributeForm() {
	return (
		<RichText
			tagName="p"
			onChange={( content ) => onChange(value)}
			placeholder="Write something…"
		/>
	);
}

render(<AttributeForm />, document.getElementById('torasen-attribute-form'));
