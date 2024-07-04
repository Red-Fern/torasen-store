import AttributeOption from "./AttributeOption";

export default function AttributeGroup({ attribute, group, options }) {
	return (
		<div className="flex flex-col gap-2">
			<div className="font-bold">{group}</div>
			<div className="flex flex-wrap gap-3">
				{options?.map((option) => (
					<AttributeOption
						attribute={attribute}
						key={option.id}
						option={option}
					/>
				))}
			</div>
		</div>

	)
}
