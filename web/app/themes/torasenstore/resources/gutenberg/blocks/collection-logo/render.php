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

function getParentTerm($term) {
    while ($term->parent != 0) {
        $term = get_term($term->parent, 'product_cat');
    }
    return $term;
}

$product = wc_get_product(get_the_ID());

if (!$product) {
    echo '<div>No Product available</div>';
    return;
}

$productID = $product->get_id();
$productCategories = wp_get_post_terms($productID, 'product_cat');

$parentTerm = '';
$imageURL = '';

if (!empty($productCategories) && !is_wp_error($productCategories)) {
    $parentTerm = getParentTerm($productCategories[0]);

    if (!is_wp_error($parentTerm)) {
        $thumbnailID = get_term_meta($parentTerm->term_id, 'thumbnail_id', true);
        $imageURL = wp_get_attachment_url($thumbnailID);
    }
}
?>

<?php if (!empty($imageURL)): ?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <img src="<?php echo esc_url($imageURL); ?>" class="max-w-[104px] max-h-[33px] | lg:max-w-[208px] lg:max-h-[66px]" alt="<?php echo esc_attr($parentTerm->name); ?>">
    </div>
<?php endif; ?>
 
 