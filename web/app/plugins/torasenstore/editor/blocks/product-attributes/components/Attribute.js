import AttributeOption from "./AttributeOption";
import HelpPanel from "./HelpPanel";

export default function Attribute({ attribute }) {
	return (
		<div className="flex flex-row w-full pb-4 border-b border-gray-300">
			<div className="md:w-1/4">
				<div className="flex items-center gap-2">
					<span>{attribute.label}</span>
					{attribute.help_text && (
						<HelpPanel content={attribute.help_text} />
					)}
				</div>
			</div>
			<div className="md:w-3/4">
				<div className="flex flex-wrap gap-3">
					{attribute.options.map((option) => (
						<AttributeOption
							attribute={attribute.name}
							key={option.id}
							option={option}
						/>
					))}
				</div>
			</div>
		</div>
	)
}
