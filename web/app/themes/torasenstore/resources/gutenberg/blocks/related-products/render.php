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

$relatedIDs = wc_get_related_products($product->get_id(), $limit = 8, [$product->get_id()]);

if (!empty($relatedIDs)) 
{
    $query = new WC_Product_Query([
        'posts_per_page' => $limit,
        'post__in'       => $relatedIDs,
        'orderby'        => 'post__in'
    ]);

    $products = wc_products_array_orderby($query->get_products());
}
?>

<?php if($products): ?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <div class="grid grid-cols-2 gap-xs | lg:grid-cols-4">
        <?php foreach($products as $product): ?>
                <div class="flex flex-col">
                    <div class="wc-block-components-product-image">
                        <a href="<?php echo $product->get_permalink(); ?>">
                            <?php echo $product->get_image(); ?>
                        </a>
                    </div>

                    <div class="relative flex flex-col pt-4">
                        <a href="<?php echo $product->get_permalink(); ?>">
                            <div class="mb-1 font-medium"><?php echo $product->get_name(); ?></div>

                            <div class="text-sm">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>