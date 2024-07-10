<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *https://torasen-store.test/app/uploads/2024/06/torasen-essentials-logo.svg
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<div <?php echo get_block_wrapper_attributes(); ?>>
    <ul class="list-none flex flex-wrap gap-3 p-0">
        <li>
            <a class="w-12 h-12 flex items-center justify-center border border-black" href="mailto:?body=<?php echo urlencode(get_the_permalink());?>" aria-label="Share by email" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                    <path fill="currentColor" d="M1.25 6.219 10 12.234l8.75-6.015V3.75H1.25v2.469Zm17.5 1.515L10 13.75 1.25 7.734v8.516h17.5V7.734ZM0 16.25V2.5h20v15H0v-1.25Z"/>
                </svg>
            </a>
        </li>

        <li>
            <a class="w-12 h-12 flex items-center justify-center border border-black" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_permalink());?>" aria-label="Share on Twitter" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" fill="none">
                    <path fill="currentColor" d="M15.7 0h3.1l-6.7 7.7L20 18.1h-6.2L9 11.8l-5.5 6.3H.4l7.2-8.2L0 0h6.3l4.4 5.8 5-5.8zm-1 16.2h1.7L5.4 1.7H3.6l11.1 14.5z"/>
                </svg>
            </a>
        </li>

        <li>
            <a class="w-12 h-12 flex items-center justify-center border border-black" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_the_permalink());?>" aria-label="Share on LinkedIn" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none">
                    <path fill="currentColor" d="M3.906 18H.273V6.32h3.633V18ZM2.07 4.758C.938 4.758 0 3.78 0 2.609 0 1.008 1.719-.008 3.125.813c.664.351 1.055 1.054 1.055 1.796 0 1.172-.938 2.149-2.11 2.149ZM17.46 18h-3.593v-5.664c0-1.367-.039-3.086-1.914-3.086s-2.148 1.445-2.148 2.969V18H6.172V6.32h3.476v1.602h.04c.507-.899 1.68-1.875 3.437-1.875 3.672 0 4.375 2.422 4.375 5.547V18h-.04Z"/>
                </svg>
            </a>
        </li>
    </ul>
</div>