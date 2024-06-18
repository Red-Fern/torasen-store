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

$productID = $product->get_id();

?>

<div <?php echo get_block_wrapper_attributes(); ?>>
    <button class="modal-button flex justify-between items-center gap-4 py-4 px-0 w-full border-t border-mid-grey bg-transparent text-left font-medium" data-content="dimensions">
        Dimensions

        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path fill="currentColor" d="m18.004 10.441.441-.44-.441-.442-6.563-6.563L11 2.555l-.883.883.442.441 5.496 5.496H1v1.25h15.055l-5.496 5.496-.442.442.883.882.441-.441 6.563-6.563Z"/>
        </svg>
    </button>

    <button class="modal-button flex justify-between items-center gap-4 py-4 px-0 w-full border-t border-mid-grey bg-transparent text-left font-medium" data-content="downloads">
        Downloads & CAD

        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path fill="currentColor" d="m18.004 10.441.441-.44-.441-.442-6.563-6.563L11 2.555l-.883.883.442.441 5.496 5.496H1v1.25h15.055l-5.496 5.496-.442.442.883.882.441-.441 6.563-6.563Z"/>
        </svg>
    </button>

    <button class="modal-button flex justify-between items-center gap-4 py-4 px-0 w-full border-y border-mid-grey bg-transparent text-left font-medium" data-content="environmental">
        Environmental

        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path fill="currentColor" d="m18.004 10.441.441-.44-.441-.442-6.563-6.563L11 2.555l-.883.883.442.441 5.496 5.496H1v1.25h15.055l-5.496 5.496-.442.442.883.882.441-.441 6.563-6.563Z"/>
        </svg>
    </button>
</div>

<div x-data="offCanvasModal" x-cloak>
    <div
        x-on:click="hide"
        x-show="showing"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 w-full h-full bg-[rgba(95,95,95,.35)] z-[9999]"
    >
        <div
            x-show="showing"
            x-on:click.stop
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform translate-x-full"
            x-transition:enter-end="transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="transform translate-x-0"
            x-transition:leave-end="transform translate-x-full"
            class="fixed top-0 right-0 w-[480px] h-full max-w-full bg-white overflow-y-scroll"
        >
            <div class="flex items-center jusify-between gap-md px-lg py-xs border-b border-mid-grey">
                <div class="grow font-medium">
                    <span x-show="currentContent == 'dimensions'">Dimensions</span>
                    <span x-show="currentContent == 'downloads'">Downloads & CAD</span>
                    <span x-show="currentContent == 'environmental'">Environmental</span>
                </div>

                <button 
                    class="flex items-center justify-center w-[46px] h-[46px] bg-black"
                    x-on:click="hide"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
                        <path fill="#fff" d="m8.046 7.294-4.14-4.14-.707.705L7.34 8 3.2 12.14l.706.707 4.141-4.14 4.14 4.14.707-.706L8.753 8l4.14-4.14-.706-.707-4.14 4.14Z"/>
                    </svg>
                </button>
            </div>

            <div class="px-lg py-sm">
                <div x-show="currentContent == 'dimensions'">
                    <?php if (!empty(get_field('dimensions_image', $productID))): ?>
                        <img src="<?php echo esc_url(get_field('dimensions_image', $productID)['url']); ?>" class="mb-sm" alt="<?php echo esc_attr(get_field('dimensions_image', $productID)['alt']); ?>" />
                    <?php endif; ?>

                    <?php echo get_field('dimensions_text', $productID); ?>
                </div>

                <div x-show="currentContent == 'downloads'">
                    <?php if (get_field('downloads_files', $productID)): ?>
                        <?php foreach (get_field('downloads_files', $productID) as $download): ?>
                            <?php if ($download['file']): ?>
                                <a href="<?php echo $download['file']['url']; ?>" class="flex justify-between items-center gap-4 py-4 px-0 w-full border-b border-mid-grey" target="_blank">
                                    <?php echo $download['title'] ?: $download['file']['filename']; ?>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                        <path fill="currentColor" d="M2.625 18.75H2V17.5h15v1.25H2.625Zm7.316-3.934-.441.442-.441-.442-5-5-.442-.441.883-.883.441.442 3.934 3.933V1.25h1.25v11.617l3.934-3.933.441-.442.883.883-.442.441-5 5Z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div x-show="currentContent == 'environmental'">
                    <?php echo get_field('environmental_text', $productID); ?>
                </div>
            </div>
        </div>
    </div>
</div>