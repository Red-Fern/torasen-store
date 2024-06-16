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

$query = [
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'tax_query' => [
        [
            'taxonomy' => 'productfamily',
            'field' => 'term_id',
            'terms' => $family->term_id
        ]
    ]
];
$products = get_posts($query);
?>

<div
	<?php echo get_block_wrapper_attributes([
        'class' => 'flex flex-col gap-8'
    ]); ?>
	data-wp-interactive="torasen-family-products"
>
    <div class="flex flex-col gap-5 | md:flex-row md:justify-between md:items-start md:gap-24">
        <div class="text-xl font-bold | md:text-xl md:w-1/4">The <?php echo $family->name; ?> Family</div>
        <div class="text-md md:text-2xl md:w-3/4"><?php echo $family->description; ?></div>
    </div>
    <div>
        <?php foreach($products as $product): ?>
            <div><?php echo $product->post_title; ?></div>
        <?php endforeach; ?>
    </div>
</div>
