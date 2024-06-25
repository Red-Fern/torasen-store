import AttributeOption from "./AttributeOption";

export default function Attribute({ attribute }) {
	return (
		<div className="flex flex-row w-full">
			<div className="w-1/3">{attribute.label}</div>
			<div className="w-2/3">
				{attribute.options.map((option) => (
					<AttributeOption key={option.id} option={option} />
				))}
			</div>
		</div>
	)
}
