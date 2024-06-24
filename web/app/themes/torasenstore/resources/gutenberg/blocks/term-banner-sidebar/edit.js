/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit() {
	return (
		<div { ...useBlockProps() }>
			<div className="flex items-center justify-center w-[80px] h-[20px] bg-[#eee] | md:w-[195px] md:h-[50px]">
				<svg xmlns="http://www.w3.org/2000/svg" width="244.737" height="244.737" className="object-contain max-w-[50%] max-h-[50%]" fill="none" viewBox="0 0 124 124">
					<g fill="#e0e0e0" fill-rule="evenodd" clip-rule="evenodd">
						<path d="M110.222 10.333H13.778a3.445 3.445 0 0 0-3.445 3.445v96.444a3.445 3.445 0 0 0 3.445 3.445h96.444a3.445 3.445 0 0 0 3.445-3.445V13.778a3.445 3.445 0 0 0-3.445-3.445zM13.778 0C6.169 0 0 6.169 0 13.778v96.444C0 117.831 6.169 124 13.778 124h96.444c7.609 0 13.778-6.169 13.778-13.778V13.778C124 6.169 117.831 0 110.222 0Z"/>
						<path d="M85.954 51.407a5.166 5.166 0 0 1 7.203 0l27.556 26.79-7.204 7.409-23.954-23.289-23.954 23.289a5.166 5.166 0 0 1-6.411.631L38.553 72.861 9.933 93.73l-6.088-8.349 31.492-22.963a5.167 5.167 0 0 1 5.854-.161l20.162 13.068z"/>
					</g>
				</svg>
			</div>
		</div>
	);
}
