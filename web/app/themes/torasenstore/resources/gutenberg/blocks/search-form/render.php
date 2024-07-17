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
?>

<div <?php echo get_block_wrapper_attributes(); ?>>
    <div x-data="searchModal">
        <button 
            class="flex items-center justify-center w-12 h-12 bg-transparent" 
            x-on:click="toggle"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
                <path fill="currentColor" d="M12 6.5a5.5 5.5 0 1 0-11 0 5.5 5.5 0 0 0 11 0Zm-1.272 4.938A6.464 6.464 0 0 1 6.5 13C2.91 13 0 10.09 0 6.5S2.91 0 6.5 0 13 2.91 13 6.5a6.464 6.464 0 0 1-1.563 4.228l4.516 4.519-.706.706-4.519-4.515Z"/>
            </svg>
        </button>

        <div
            class="absolute top-full left-0 w-full h-[calc(100vh-100%)] bg-[rgba(95,95,95,.35)] z-[9999] overflow-auto"
            x-show="showing"
            x-cloak
            x-on:click="hide"
            x-on:click.away="showing = false"
        >
            <div
                x-show="showing"
                x-on:click.stop
                class="w-full py-lg bg-lightest-grey"
            >
                <div class="container text-center">
                    <form role="search" method="get" class="woocommerce-product-search inline-flex justify-center border border-black rounded-[3px] overflow-hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <label class="screen-reader-text" for="woocommerce-product-search-field"><?php esc_html_e( 'Search for:', 'woocommerce' ); ?></label>
                        <input type="search" id="woocommerce-product-search-field" class="search-field p-3" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" class="<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ); ?>"><?php echo esc_html_x( 'Search', 'submit button', 'woocommerce' ); ?></button>
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>