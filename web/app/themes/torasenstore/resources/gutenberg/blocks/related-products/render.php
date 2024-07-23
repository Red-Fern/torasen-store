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
        <div class="swiper" data-swiper='{
            "slidesPerView": "2",
            "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
            },
            "breakpoints": {
                "992": {
                    "slidesPerView": "4"
                }
            }
        }'>
            <div class="flex flex-wrap gap-md items-center | md:flex-nowrap">
                <?php if ($attributes['title']) : ?>
                    <h2 class="mb-0 w-full | md:w-auto"><?php echo $attributes['title']; ?></h2>
                <?php endif; ?>

                <div class="flex gap-2 | md:ml-auto">
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
            </div>
            
            <div class="swiper-wrapper mt-sm">
                <?php foreach($products as $product): ?>
                    <div class="swiper-slide">
                        <div class="wc-block-components-product-image">
                            <a class="has-lightest-grey-background-color" href="<?php echo $product->get_permalink(); ?>">
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
    </div>
<?php endif; ?>