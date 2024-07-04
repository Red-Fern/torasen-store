import { useEffect } from "@wordpress/element";
import { useSelect } from "@wordpress/data";
import { EXTRA_STORE_NAME } from "../../../stores/constants";
import HelpPanel from "./HelpPanel";
import ExtraOption from "./ExtraOption";

export default function ExtraField({ field }) {
	const options = useSelect((select) => {
		return select(EXTRA_STORE_NAME).getOptions(field.id);
	}, [field]);

	const selectedOptions = useSelect((select) => {
		return select(EXTRA_STORE_NAME).getSelectedOptions();
	})

	useEffect(() => {
		const checkboxes = document.querySelectorAll(`input[name="wapf[field_${field.id}][]"]`);
		checkboxes.forEach(checkbox => {
			checkbox.checked = selectedOptions.includes(checkbox.value);

			const event = new Event('change', {
				bubbles: true, // Bubble up the DOM
				cancelable: true // Can be cancelled
			});

			// Dispatch the event on the checkbox
			checkbox.dispatchEvent(event);
		});

	}, [selectedOptions]);

	return (
		<div className="flex flex-col gap-3 w-full pb-4 border-b border-gray-300 | md:flex-row">
			<div className="md:w-1/4">
				<div className="flex items-center gap-2">
					<span>{field.name}</span>
				</div>
			</div>
			<div className="md:w-3/4">
				<div className="flex flex-wrap gap-3">
					{options.map((option) => (
						<ExtraOption
							key={option.slug}
							fieldId={field.id}
							option={option}
						/>
					))}
				</div>
			</div>
		</div>
	)
}
