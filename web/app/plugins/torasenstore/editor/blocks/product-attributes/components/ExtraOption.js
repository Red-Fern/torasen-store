import { useState } from '@wordpress/element';
import { store as extrasStore } from '../store/extras';
import { useSelect, useDispatch } from '@wordpress/data';

export default function ExtraOption({ fieldId, option }) {
	const isSelected = useSelect((select) => select(extrasStore).isSelected(option.slug));

	const { selectOption } = useDispatch(extrasStore);

	const chooseOption = () => {
		selectOption(option.slug);
	}

	return (
		<button
			type="button"
			className={`flex items-center border border-gray-300 ${isSelected ? 'bg-white' : 'bg-transparent'}`}
			onClick={() => chooseOption()}
		>
			<span className="block py-3 px-4 border-r border-gray-300">{option.label}</span>
			<span className="block py-3 px-4">+£{option.pricing_amount}</span>
		</button>
	)
}
