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
    <?php echo get_block_wrapper_attributes(['class' => 'first:border-t border-b border-mid-grey transition-colors duration-300']); ?>
    data-wp-interactive="rfAccordionItem"
    <?php echo wp_interactivity_data_wp_context([
        'uniqueId' => $slug ?: $unique_id,
    ]); ?>
    data-wp-class--active="callbacks.isOpen"
>
    <button
        data-wp-on--click="actions.selectTab"
        data-wp-bind--aria-expanded="context.isOpen"
        aria-controls="<?php echo esc_attr($unique_id); ?>"
        class="flex justify-between items-center gap-sm w-full py-sm bg-transparent text-md font-medium"
    >
        <?php esc_html_e($label, 'accordion-item'); ?>

        <span class="accordion-icon inline-block w-5 h-5 transition duration-300"></span>
    </button>

    <div
        id="<?php echo esc_attr($unique_id); ?>"
        class="accordion-panel grid transition-[grid-template-rows] duration-500"
    >
        <div class="overflow-hidden">
            <div class="pb-sm">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
