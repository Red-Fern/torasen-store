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

$product = wc_get_product(get_the_ID());

if (!$product) {
    echo '<div>No Product available</div>';
    return;
}

?>

<div <?php echo get_block_wrapper_attributes(); ?>>
    <?php var_dump(wc_get_related_products( $product->get_id(), 8, [$product->get_id()] )); ?>
</div>