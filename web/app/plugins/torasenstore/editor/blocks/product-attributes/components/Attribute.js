import AttributeOption from "./AttributeOption";
import HelpPanel from "./HelpPanel";
import AttributeGroup from "./AttributeGroup";

function groupOptions(options) {
	return options.reduce((acc, option) => {
		const category = option.category || 'default';
		if (!acc[category]) {
			acc[category] = [];
		}
		acc[category].push(option);
		return acc;
	}, {});
}

export default function Attribute({ attribute }) {
	const isGrouped = attribute.display_type === 'grouped';
	const options = isGrouped ? groupOptions(attribute.options) : attribute.options;

	return (
		<div className="flex flex-col gap-3 w-full pb-4 border-b border-gray-300 | md:flex-row">
			<div className="md:w-1/4">
				<div className="flex items-center gap-2">
					<span>{attribute.label}</span>
					{attribute.help_text && (
						<HelpPanel
							title={attribute.label}
							content={attribute.help_text}
						/>
					)}
				</div>
			</div>
			<div className="md:w-3/4">
				{isGrouped ? (
					<div className="flex flex-col gap-3">
						{Object.entries(options).map(([group, groupOptions]) => (
							<AttributeGroup
								attribute={attribute.name}
								group={group}
								key={group}
								options={groupOptions}
							/>
						))}
					</div>
				) : (
					<div className="flex flex-wrap gap-3">
						{options?.map((option) => (
							<AttributeOption
								attribute={attribute.name}
								key={option.id}
								option={option}
							/>
						))}
					</div>
				)}
			</div>
		</div>
	)
}
