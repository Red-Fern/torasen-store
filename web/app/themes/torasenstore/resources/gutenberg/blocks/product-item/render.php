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

if (!function_exists('getRangeProducts')) {
    function getRangeProducts($productId)
    {
        $productRanges = wp_get_object_terms($productId, 'productrange', array('fields' => 'all'));
        if (is_wp_error($productRanges) || empty($productRanges)) {
            return [];
        }

        $range = $productRanges[0];
        return wc_get_products([
            'post__not_in' => [$productId],
            'tax_query' => [
                [
                    'taxonomy' => 'productrange',
                    'field' => 'term_id',
                    'terms' => $range->term_id
                ]
            ]
        ]);
    }
}

$productId = $block->context['postId'];
/** @var WC_Product $product */
$product = wc_get_product($productId);
$rangeProducts = getRangeProducts($productId);

?>

<div
    <?php echo get_block_wrapper_attributes([
        'class' => 'relative group hover:border-r hover:border-b hover:border-black',
    ]); ?>
    data-wp-interactive="product-item"
    <?php echo wp_interactivity_data_wp_context(array( 'isOpen' => false )); ?>
    data-wp-watch="callbacks.logIsOpen"
>
    <div class="flex flex-col">
        <?php echo $product->get_image(); ?>

        <div class="flex flex-col">
            <a class="block p-2 group-hover:order-1" href="<?php echo $product->get_permalink(); ?>">
                <?php echo $product->get_name(); ?>
            </a>
            <?php if (!empty($rangeProducts)) : ?>
                <div class="overflow-hidden hidden group-hover:block">
                    <swiper-container slides-per-view="4" loop="true">
                        <?php foreach ($rangeProducts as $product) : ?>
                            <swiper-slide>
                                <?php echo $product->get_image(); ?>
                            </swiper-slide>
                        <?php endforeach; ?>
                    </swiper-container>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
