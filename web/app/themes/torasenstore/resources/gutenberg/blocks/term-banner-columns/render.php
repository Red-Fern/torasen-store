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

$term = get_queried_object();

if (!$term) {
    echo '<div>No Term available</div>';
    return;
}

?>

<?php if (have_rows('columns', $term)): ?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <div class="flex flex-wrap justify-end gap-md mt-2xl | md:flex-nowrap | lg:mt-[calc(var(--wp--preset--spacing--xxl)*2)]">
            <?php foreach (get_field('columns', $term) as $column): ?>
                <div class="w-full space-y-sm | md:w-1/3 | lg:w-[195px]">
                    <?php if ($column['image']): ?>
                        <img src="<?php echo $column['image']['url']; ?>" alt="<?php echo $column['image']['alt']; ?>">
                    <?php endif; ?>

                    <?php if ($column['text']): ?>
                        <div class="flex flex-col space-y-2 text-sm">
                            <?php echo $column['text']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>