import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Edit( {
	attributes: {
		title
	},
	setAttributes
} ) {
	const blockProps = useBlockProps();
	
	return (
		<div { ...blockProps }>
			<RichText
				tagName='h2'
				value={title}
				allowedFormats={['core/bold', 'core/italic']}
				onChange={(value) => setAttributes({ title: value })}
			/>

			<div className="mt-md border-t border-mid-grey">
				<div className="flex flex-wrap items-center py-xs border-b border-mid-grey | lg:flex-nowrap lg:justify-end">
					<div className="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
						<div className="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
						<div className="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
						<div className="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
					</div>
				</div>

				<div className="flex flex-wrap items-center py-xs border-b border-mid-grey | lg:flex-nowrap lg:justify-end">
					<div className="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
						<div className="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
						<div className="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
					</div>
				</div>

				<div className="flex flex-wrap items-center py-xs border-b border-mid-grey | lg:flex-nowrap lg:justify-end">
					<div className="w-full flex gap-sm overflow-x-scroll | lg:flex-wrap lg:w-4/5 lg:justify-end">
						<div className="shrink-0 w-[150px] h-[150px] bg-lightest-grey"></div>
					</div>
				</div>
			</div>
		</div>
	);
}
