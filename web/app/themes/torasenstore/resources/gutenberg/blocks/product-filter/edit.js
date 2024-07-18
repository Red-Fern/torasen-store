import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit({
	attributes: {
		filterId
	},
	setAttributes
}) {
	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Product Filter', 'torasenstore' ) }>
					<TextControl
						label={ __( 'Filter ID', 'torasenstore' ) }
						value={ filterId }
						onChange={(value) => setAttributes({ filterId: value })}
					/>
				</PanelBody>
			</InspectorControls>

			<div className="border-b border-mid-grey space-y-sm divide-y divide-mid-grey">
				<div className="flex items-center gap-3">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none">
						<path fill="#CFCDAF" d="M0 14.063v1.124H2.813v2.251h5.625v-2.25H18v-1.126H8.437v-2.25H2.813v2.25H0Zm7.313 1.124v1.126H3.938v-3.375h3.374v2.25ZM0 8.438v1.126h9.563v2.25H15.187v-2.25H18V8.437H15.187V6.188H9.563v2.25H0Zm3.938-4.5v2.251h5.625v-2.25H18V2.812H9.562V.563H3.938v2.25H0v1.124H3.938Zm1.124 0v-2.25h3.375v3.375H5.063V3.938Zm9 4.5v2.25h-3.374V7.313h3.374v1.125Z"/>
					</svg>

					<span>Filter products</span>
				</div>

				<div className="py-sm">
					<div className="mb-4 font-medium">Category</div>

					<div className="border-b border-mid-grey divide-y divide-mid-grey">
						<div className="py-2">Option</div>
						<div className="py-2">Option</div>
						<div className="py-2">Option</div>
					</div>
				</div>
			</div>
		</div>
	);
}

