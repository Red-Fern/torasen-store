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

$query = [
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'publish',
];
$family = $attributes['family'] ? $attributes['family'] : '';
if ($family) {
    $query['tax_query'] = [
        [
            'taxonomy' => 'productfamily',
            'field' => 'term_id',
            'terms' => $family
        ]
    ];
} else {
    $termIds = wp_get_object_terms($GLOBALS['post']->ID, 'productfamily');
    $query['tax_query'] = [
        [
            'taxonomy' => 'productfamily',
            'field' => 'term_id',
            'terms' => $termIds[0]->term_id
        ]
    ];
}

$products = get_posts($query);
?>

<div
	<?php echo get_block_wrapper_attributes(); ?>
	data-wp-interactive="torasen-family-products"
>
    <div class="flex justify-between items-start">
        <div class="text-xl">The Saturn Family</div>
        <div><?php echo 'saturn text'; ?></div>
    </div>
    <div>
        <?php foreach($products as $product): ?>
            <div><?php echo $product->post_title; ?></div>
        <?php endforeach; ?>
    </div>
</div>
