/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save() {
	return (
		<div { ...useBlockProps.save() }>
			<button class="flex justify-between items-center gap-4 py-4 px-0 w-full border-t border-mid-grey bg-transparent text-left font-medium">
				Dimensions 

				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
					<path fill="currentColor" d="m18.004 10.441.441-.44-.441-.442-6.563-6.563L11 2.555l-.883.883.442.441 5.496 5.496H1v1.25h15.055l-5.496 5.496-.442.442.883.882.441-.441 6.563-6.563Z"/>
				</svg>
			</button>

			<button class="flex justify-between items-center gap-4 py-4 px-0 w-full border-t border-mid-grey bg-transparent text-left font-medium">
				Downloads & CAD

				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
					<path fill="currentColor" d="m18.004 10.441.441-.44-.441-.442-6.563-6.563L11 2.555l-.883.883.442.441 5.496 5.496H1v1.25h15.055l-5.496 5.496-.442.442.883.882.441-.441 6.563-6.563Z"/>
				</svg>
			</button>

			<button class="flex justify-between items-center gap-4 py-4 px-0 w-full border-y border-mid-grey bg-transparent text-left font-medium">
				Environmental

				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
					<path fill="currentColor" d="m18.004 10.441.441-.44-.441-.442-6.563-6.563L11 2.555l-.883.883.442.441 5.496 5.496H1v1.25h15.055l-5.496 5.496-.442.442.883.882.441-.441 6.563-6.563Z"/>
				</svg>
			</button>
		</div>
	);
}
