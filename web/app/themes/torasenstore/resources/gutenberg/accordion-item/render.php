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
?>

<div
    <?php echo get_block_wrapper_attributes(); ?>
    data-wp-interactive="rfAccordionItem"
    <?php echo wp_interactivity_data_wp_context([
        'uniqueId' => $unique_id,
    ]); ?>
>
    <button
        data-wp-on--click="actions.selectTab"
        data-wp-bind--aria-expanded="context.isOpen"
        aria-controls="<?php echo esc_attr($unique_id); ?>"
        class="py-2 px-4 bg-transparent"
    >
        <?php esc_html_e($label, 'accordion-item'); ?>
    </button>

    <div
        id="<?php echo esc_attr($unique_id); ?>"
        data-wp-bind--hidden="!callbacks.isOpen"
    >
        <?php echo $content; ?>
    </div>
</div>
