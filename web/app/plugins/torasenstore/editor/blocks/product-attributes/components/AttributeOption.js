import { useState } from '@wordpress/element';
import { store as attributeStore } from '../store';
import { useSelect, useDispatch } from '@wordpress/data';

export default function AttributeOption({ attribute, option }) {
	const selectedOption = useSelect((select) => {
		return select(attributeStore).getSelected(attribute);
	})

	const { selectAttribute } = useDispatch(attributeStore);

	const chooseOption = () => {
		selectAttribute(attribute, option.slug);
		document.querySelector(`select[name="attribute_${attribute}"]`).value = option.slug;
	}

	return (
		<button
			type="button"
			className={`border border-gray-300 py-3 px-4 ${selectedOption === option.slug ? 'bg-white' : 'bg-transparent'}`}
			onClick={() => chooseOption()}
		>{option.name}</button>
	)
}
