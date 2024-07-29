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
			className={`flex items-center border border-gray-300 ${selectedOption === option.slug ? 'bg-white' : 'bg-transparent'}`}
			onClick={() => chooseOption()}
		>
			{option.swatch && (
				<span className="h-full block py-3 px-3 border-r border-gray-300 grid place-items-center">
					<img className="w-3 h-3 object-cover" src={option.swatch} alt={option.name}/>
				</span>
			)}
			<span className="block py-2 px-4">{option.name}</span>
		</button>
	)
}
