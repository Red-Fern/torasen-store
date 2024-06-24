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

$term = get_queried_object();

if (!$term) {
    echo '<div>No Term available</div>';
    return;
}

?>

<?php if (get_field('sidebar', $term) && (get_field('sidebar', $term)['image'] || get_field('sidebar', $term)['text'])): ?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <div class="space-y-sm | md:max-w-[195px]">
            <?php if (get_field('sidebar', $term)['image']): ?>
                <div class="max-w-[80px] | md:max-w-[195px]">
                    <img src="<?php echo get_field('sidebar', $term)['image']['url']; ?>" class="object-contain" alt="<?php echo get_field('sidebar', $term)['image']['alt']; ?>">
                </div>
            <?php endif; ?>

            <?php if (get_field('sidebar', $term)['text']): ?>
                <div class="flex flex-col space-y-2 text-sm">
                    <?php echo get_field('sidebar', $term)['text']; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>