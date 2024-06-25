import AttributeOption from "./AttributeOption";
import HelpPanel from "./HelpPanel";

export default function Attribute({ attribute }) {
	console.log(attribute.help_text);
	return (
		<div className="flex flex-row w-full">
			<div className="w-1/3">{attribute.label}</div>
			<div className="w-2/3">
				{attribute.help_text && (
					<HelpPanel content={attribute.help_text} />
				)}

				{attribute.options.map((option) => (
					<AttributeOption key={option.id} option={option} />
				))}
			</div>
		</div>
	)
}
