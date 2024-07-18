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
    <div x-data="productFilter">
        <button 
            class="flex items-center gap-3 mb-sm bg-transparent"
            x-on:click="toggle"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none">
                <path fill="#CFCDAF" d="M0 14.063v1.124H2.813v2.251h5.625v-2.25H18v-1.126H8.437v-2.25H2.813v2.25H0Zm7.313 1.124v1.126H3.938v-3.375h3.374v2.25ZM0 8.438v1.126h9.563v2.25H15.187v-2.25H18V8.437H15.187V6.188H9.563v2.25H0Zm3.938-4.5v2.251h5.625v-2.25H18V2.812H9.562V.563H3.938v2.25H0v1.124H3.938Zm1.124 0v-2.25h3.375v3.375H5.063V3.938Zm9 4.5v2.25h-3.374V7.313h3.374v1.125Z"/>
            </svg>

            <span
                x-text="showing ? 'Hide filters' : 'Filter products'"
            >
            </span>
        </button>
        
        <div 
            class="fixed top-0 left-0 h-full w-full bg-white overflow-auto z-10 | md:static md:h-auto mf:bg-transparent"
            x-show="showing"
            x-cloak
        >
            <div class="px-xs py-4 bg-lightest-grey | md:hidden">
                <button
                    class="flex items-center justify-center -ml-4 w-12 h-12 bg-transparent"
                    x-on:click="hide"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
                        <path fill="currentColor" d="m8.047 7.294-4.14-4.14-.707.705L7.34 8 3.2 12.14l.706.707 4.141-4.14 4.14 4.14.707-.706L8.754 8l4.14-4.14-.706-.707-4.14 4.14Z"/>
                    </svg>
                </button>
            </div>

            <div class="p-xs | md:p-0">
                <?php echo do_shortcode('[searchandfilter id="' . $attributes['filterId'] . '"]'); ?>
            </div>
        </div>
    </div>
</div>
