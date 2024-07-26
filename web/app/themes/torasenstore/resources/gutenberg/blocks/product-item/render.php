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
        $productCategories = wc_get_product_term_ids($productId, 'product_cat');  
        
        return wc_get_products([
            'post__not_in' => [$productId],
            'tax_query' => [
                [
                    'taxonomy' => 'productrange',
                    'field' => 'term_id',
                    'terms' => $range->term_id
                ],
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $productCategories,
                    'operator' => 'IN',
                ],
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

$imageUrl = wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_thumbnail', false);
$srcSet = wp_get_attachment_image_srcset( $product->get_image_id(), 'woocommerce_thumbnail', false);
?>

<div
    <?php echo get_block_wrapper_attributes([
        'class' => 'relative group',
    ]); ?>
    data-wp-interactive="product-item"
    <?php echo wp_interactivity_data_wp_context([
        'imageUrl' => $imageUrl,
        'originalImageUrl' => $imageUrl,
        'srcSet' => $srcSet,
        'originalSrcSet' => $srcSet,
    ]); ?>
    data-wp-init="callbacks.cacheImage"
>
    <div class="flex flex-col">
        <div class="wc-block-components-product-image relative border border-b-0 border-transparent has-lightest-grey-background-color <?php echo !empty($rangeProducts) ? 'group-hover:border-dark-grey' : ''; ?>">
            <a href="<?php echo $product->get_permalink(); ?>">
                <img
                    data-wp-bind--src="context.imageUrl"
                    data-wp-bind--srcset="context.srcSet"
                    alt=""
                    decoding="async"
                    loading="lazy"
                    class="mix-blend-multiply"
                />

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
                <div class="hidden absolute top-0 left-0 w-full min-h-full border border-t-white border-dark-grey bg-white z-10 overflow-hidden | group-hover:block">
                    <div class="max-h-[100px] overflow-hidden">
                        <swiper-container slides-per-view="4" loop="false" mousewheel-force-to-axis="true" free-mode="true">
                            <swiper-slide class="slide-product-thumbnial" >
                                <a href="<?php echo $product->get_permalink(); ?>" class="block has-lightest-grey-background-color">
                                    <?php echo $product->get_image('woocommerce_thumbnail', [
                                        'data-wp-on--mouseover' => 'actions.changeImage',
                                        'data-wp-on--mouseout' => 'actions.revertImage',
                                    ]); ?>
                                </a>
                            </swiper-slide>

                            <?php foreach ($rangeProducts as $product) : ?>
                                <swiper-slide class="slide-product-thumbnial" >
                                    <a href="<?php echo $product->get_permalink(); ?>" class="block has-lightest-grey-background-color">
                                        <?php echo $product->get_image('woocommerce_thumbnail', [
                                            'data-wp-on--mouseover' => 'actions.changeImage',
                                            'data-wp-on--mouseout' => 'actions.revertImage',
                                        ]); ?>
                                    </a>
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
