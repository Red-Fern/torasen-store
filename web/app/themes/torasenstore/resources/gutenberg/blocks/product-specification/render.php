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
            class="fixed top-0 right-0 p-xs w-[480px] h-full max-w-full bg-white overflow-y-scroll"
        >
            <button x-on:click="hide">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 19 18" fill="none">
                    <path d="M7.43532 9.26345L1.07136 15.6274L3.19268 17.7487L9.55664 11.3848L15.9206 17.7487L18.0419 15.6274L11.678 9.26346L18.749 2.19239L16.6277 0.0710677L9.55664 7.14213L2.48557 0.0710663L0.364254 2.19239L7.43532 9.26345Z" fill="currentColor" />
                </svg>
            </button>

            <div x-show="currentContent == 'dimensions'">
                <?php if (!empty(get_field('dimensions_image', $productID))): ?>
                    <img src="<?php echo esc_url(get_field('dimensions_image', $productID)['url']); ?>" alt="<?php echo esc_attr(get_field('dimensions_image', $productID)['alt']); ?>" />
                <?php endif; ?>
                <?php echo get_field('dimensions_text', $productID); ?>
            </div>

            <div x-show="currentContent == 'downloads'">
                <?php if (get_field('downloads_files', $productID)): ?>
                    <?php foreach (get_field('downloads_files', $productID) as $download): ?>
                        <?php if ($download['file']): ?>
                            <a href="<?php echo $download['file']['url']; ?>"><?php echo $download['file']['filename']; ?></a>
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