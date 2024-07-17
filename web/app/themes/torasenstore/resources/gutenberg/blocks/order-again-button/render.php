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

$is_order_received_page = is_order_received_page();
$order_template_data = null;
$error_message = null;

if ($is_order_received_page) {
    global $wp;
    $order_id = absint($wp->query_vars['order-received']);

    if ($order_id) {
        $order = wc_get_order($order_id);

        if ($order && $order->get_user_id() === get_current_user_id()) {
            $order_template_data = array(
                'order'           => $order,
                'wp_button_class' => wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '',
                'order_again_url' => wp_nonce_url(add_query_arg('order_again', $order->get_id(), wc_get_cart_url()), 'woocommerce-order_again'),
            );
        } else {
            // Handle unauthorized access or order not found
            $error_message = __('You are not authorized to view this order.', 'torasenstore');
        }
    }
}
?>

<div <?php echo get_block_wrapper_attributes(); ?>>
    <?php if ($is_order_received_page): ?>
        <?php if ($order_template_data): ?>
            <?php wc_get_template('order/order-again.php', $order_template_data); ?>
        <?php elseif ($error_message): ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    <?php endif; ?>
</div>
