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
$unique_id = wp_unique_id( 'p-' );

$family = \RFOrigin\Products::parseProductFamily($attributes['family']);
if (!$family) {
    echo '<div>No Product Family available</div>';
    return;
}

$query = new WC_Product_Query([
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'tax_query' => [
        [
            'taxonomy' => 'productfamily',
            'field' => 'term_id',
            'terms' => $family->term_id
        ]
    ]
]);
$products = wc_products_array_orderby($query->get_products());

?>

<div
	<?php echo get_block_wrapper_attributes([
        'class' => 'flex flex-col gap-md | lg:gap-lg'
    ]); ?>
	data-wp-interactive="torasen-family-products"
>
    <div class="flex flex-col-reverse gap-2xl | md:flex-row md:justify-between md:gap-lg">
        <div class="md:w-1/3">
            <h2 class="wp-block-heading mb-0">
                <span class="hidden md:block" aria-hidden="true">The <?php echo $family->name; ?> family</span>
                <span class="md:hidden">Part of the <?php echo $family->name; ?> family</span>
            </h2>
        </div>

        <?php if ($family->description): ?>
            <div class="md:w-2/3">
                <h2 class="wp-block-heading md:text-dark-grey"><?php echo $family->description; ?></h2>
            </div>
        <?php endif; ?>
    </div>

    <div>
        <div class="swiper right-bleed mobile-only" data-swiper='{
            "slidesPerView": "auto",
            "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
            },
            "slidesPerGroup": 1
        }'>
            <div class="flex gap-2 mb-sm pr-root | md:hidden">
                <button class="swiper-button-prev p-0 w-11 h-11 rounded-full border border-black bg-transparent flex items-center justify-center" aria-label="Previous slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                        <path d="M1.15391 7.83774L0.800781 8.19087L1.15391 8.54399L6.40391 13.794L6.75703 14.1471L7.46328 13.4409L7.11016 13.0877L2.71328 8.69087H14.257H14.757V7.69087H14.257H2.71328L7.11016 3.29399L7.46328 2.94087L6.75703 2.23462L6.40391 2.58774L1.15391 7.83774Z" fill="#1D1D1B"/>
                    </svg>
                </button>

                <button class="swiper-button-next p-0 w-11 h-11 rounded-full border border-black bg-transparent flex items-center justify-center" aria-label="Next slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                        <path d="M14.4039 8.54399L14.757 8.19087L14.4039 7.83774L9.15391 2.58774L8.80078 2.23462L8.09453 2.94087L8.44766 3.29399L12.8445 7.69087H1.30078H0.800781V8.69087H1.30078H12.8445L8.44766 13.0877L8.09453 13.4409L8.80078 14.1471L9.15391 13.794L14.4039 8.54399Z" fill="#1D1D1B"/>
                    </svg>
                </button>
            </div>

            <div class="swiper-wrapper | md:!grid md:gap-xs md:grid-cols-4 | xl:grid-cols-7">
                <?php foreach($products as $product): ?>
                    <div class="swiper-slide | max-md:!w-[172px]">
                        <div class="space-y-xs">
                            <a href="<?php echo $product->get_permalink(); ?>" class="aspect-[1/1] block has-lightest-grey-background-color">
                                <?php echo wp_get_attachment_image(get_post_thumbnail_id($product->get_id()), 'medium', '', ['class' => 'w-full h-full object-contain mix-blend-multiply aspect-[1/1] ']); ?>
                            </a>
    
                            <h3 class="text-base">
                                <a href="<?php echo $product->get_permalink(); ?>">
                                    <?php echo $product->get_title(); ?>
                                </a>
                            </h3>

                            <?php echo $product->get_price_html(); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>