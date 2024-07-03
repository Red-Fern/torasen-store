import { useState } from '@wordpress/element';
import { ATTRIBUTE_STORE_NAME } from "../../../stores/constants";
import { useSelect, useDispatch } from '@wordpress/data';

export default function AttributeOption({ attribute, option }) {
	const selectedOption = useSelect((select) => {
		return select(ATTRIBUTE_STORE_NAME).getSelected(attribute);
	})

	const { selectAttribute } = useDispatch(ATTRIBUTE_STORE_NAME);

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
