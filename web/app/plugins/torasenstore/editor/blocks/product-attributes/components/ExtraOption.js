import { useState } from '@wordpress/element';
import { store as extrasStore } from '../store/extras';
import { useSelect, useDispatch } from '@wordpress/data';

export default function ExtraOption({ fieldId, option }) {
	const isSelected = useSelect((select) => select(extrasStore).isSelected(option.slug));

	const { selectOption } = useDispatch(extrasStore);

	const chooseOption = () => {


		if (!isSelected) {

		}

		selectOption(option.slug);

		// document.querySelector(`select[name="attribute_${attribute}"]`).value = option.slug;
	}

	return (
		<button
			type="button"
			className={`border border-gray-300 py-3 px-4 ${isSelected ? 'bg-white' : 'bg-transparent'}`}
			onClick={() => chooseOption()}
		>{option.label}</button>
	)
}
