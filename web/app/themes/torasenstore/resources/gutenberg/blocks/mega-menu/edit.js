/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

// Additional imports
import { InspectorControls, RichText, useBlockProps } from '@wordpress/block-editor';
import { ComboboxControl, PanelBody, TextControl } from '@wordpress/components';
import { useEntityRecords } from '@wordpress/core-data';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { label, menuSlug } = attributes;

	// Fetch all template parts
	const { hasResolved, records } = useEntityRecords(
		'postType',
		'wp_template_part',
		{ per_page: -1 }
	);

	let menuOptions = [];

	// Filter the template parts for those in the 'menu' area
	if ( hasResolved ) {
		menuOptions = records
			.filter( ( item ) => item.area === 'menu' )
			.map( ( item ) => ( {
				label: item.title.rendered, // Title of the template part
				value: item.slug,           // Template part slug
			} ) );
	}

	return (
		<>
			<InspectorControls>
				<PanelBody
					title='Settings'
					initialOpen={ true }
				>
					<TextControl
						label='Label'
						type="text"
						value={ label }
						onChange={ ( value ) =>
							setAttributes( { label: value } )
						}
						autoComplete="off"
					/>
					<ComboboxControl
						label='Menu Template'
						value={ menuSlug }
						options={ menuOptions }
						onChange={ ( slugValue ) =>
							setAttributes( { menuSlug: slugValue } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				<a className="wp-block-navigation-item__content">
					<RichText
						identifier="label"
						className="wp-block-navigation-item__label"
						value={ label }
						onChange={ ( labelValue ) =>
							setAttributes( {
								label: labelValue,
							} )
						}
						aria-label='Mega menu link text'
						placeholder='Add label...'
						allowedFormats={ [
							'core/bold',
							'core/italic',
							'core/image',
							'core/strikethrough',
						] }
					/>
				</a>
			</div>
		</>
	);
}