import { useState } from '@wordpress/element';

export default function AttributeOption({ option }) {
	const [selected, setSelected] = useState(false);
	return (
		<button
			type="button"
			className={`border border-gray-300 py-3 px-4 ${selected ? 'bg-white' : 'bg-transparent'}`}
		>{option.name}</button>
	)
}
