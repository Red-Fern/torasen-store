<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Generate unique id for aria-controls.
$unique_id = wp_unique_id('p-');
$label = $attributes['label'] ?? 'Accordion Item';
$slug = $attributes['slug'] ?? '';
?>
<div
    <?php echo get_block_wrapper_attributes(['class' => 'first:border-t border-b border-black']); ?>
    data-wp-interactive="rfAccordionItem"
    <?php echo wp_interactivity_data_wp_context([
        'uniqueId' => $slug ?: $unique_id,
    ]); ?>
    data-wp-class--bg-white="callbacks.isOpen"
>
    <button
        data-wp-on--click="actions.selectTab"
        data-wp-bind--aria-expanded="context.isOpen"
        aria-controls="<?php echo esc_attr($unique_id); ?>"
        class="flex justify-between items-center w-full py-6 px-4 bg-transparent"
    >
        <?php esc_html_e($label, 'accordion-item'); ?>
        <div class="transition" data-wp-class--rotate-90="callbacks.isOpen">
            <svg class="w-6 h-6 text-black" viewBox="0 0 15 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path id="Arrow 1" d="M15.3536 4.35355C15.5488 4.15829 15.5488 3.84171 15.3536 3.64645L12.1716 0.464467C11.9763 0.269205 11.6597 0.269205 11.4645 0.464467C11.2692 0.659729 11.2692 0.976312 11.4645 1.17157L14.2929 4L11.4645 6.82843C11.2692 7.02369 11.2692 7.34027 11.4645 7.53553C11.6597 7.7308 11.9763 7.7308 12.1716 7.53553L15.3536 4.35355ZM-4.37114e-08 4.5L15 4.5L15 3.5L4.37114e-08 3.5L-4.37114e-08 4.5Z"/>
            </svg>
        </div>
    </button>

    <div
        id="<?php echo esc_attr($unique_id); ?>"
        data-wp-bind--hidden="!callbacks.isOpen"
        class="p-3"
    >
        <?php echo $content; ?>
    </div>
</div>
