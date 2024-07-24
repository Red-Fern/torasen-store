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

$productId = isset($block->context['postId']) ? $block->context['postId'] : 0;

if (empty($productId)) {
    return;
}

/** @var WC_Product $product */
$product = wc_get_product($productId);
$rangeProducts = getRangeProducts($productId);

?>

<div
    <?php echo get_block_wrapper_attributes([
        'class' => 'relative group',
    ]); ?>
    data-wp-interactive="product-item"
    <?php echo wp_interactivity_data_wp_context(array( 'isOpen' => false )); ?>
    data-wp-watch="callbacks.logIsOpen"
>
    <div class="flex flex-col">
        <div class="wc-block-components-product-image relative border border-b-0 border-transparent <?php echo !empty($rangeProducts) ? 'group-hover:border-dark-grey' : ''; ?>">
            <a href="<?php echo $product->get_permalink(); ?>">
                <?php echo $product->get_image(); ?>

                <?php if (has_term('shipped-next-day', 'product_cat', $product->get_id())): ?>
                    <span class="absolute top-xs right-xs px-3 py-1 bg-white font-mono text-xs uppercase tracking-wider | xl:top-md xl:right-md xl:px-5">Next day delivery</span>
                <?php endif; ?>
            </a>
        </div>

        <div class="relative flex flex-col pt-4">
            <a href="<?php echo $product->get_permalink(); ?>" class="border border-t-0 border-transparent">
                <div class="mb-1 font-medium"><?php echo $product->get_name(); ?></div>

                <div class="text-sm">
                    <?php echo $product->get_price_html(); ?>
                </div>
            </a>

            <?php if (!empty($rangeProducts)) : ?>
                <div class="hidden absolute top-0 left-0 w-full min-h-full border border-t-0 border-dark-grey bg-white z-10 overflow-hidden | group-hover:block">
                    <div class="max-h-[100px] overflow-hidden">
                        <swiper-container slides-per-view="4" loop="true">
                            <?php foreach ($rangeProducts as $product) : ?>
                                <swiper-slide>
                                    <?php echo $product->get_image(); ?>
                                </swiper-slide>
                            <?php endforeach; ?>
                        </swiper-container>
                    </div>

                    <div class="p-4">
                        <a href="<?php echo $product->get_permalink(); ?>" class="border border-t-0 border-transparent">
                            <div class="mb-1 font-medium"><?php echo $product->get_name(); ?></div>

                            <div class="text-sm">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
