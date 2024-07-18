<?php

namespace RFOrigin;

class WooCommerce
{
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'registerImageSizes']);
        add_filter('use_block_editor_for_post_type', [__CLASS__, 'enableBlockEditor'], 10, 2);
        add_filter('woocommerce_resize_images', static function() {  return false; });
        add_action('woocommerce_before_quantity_input_field', [__CLASS__, 'quantityLabel']);
        add_filter('body_class', [__CLASS__, 'addLogInClass']);
        add_filter('the_content', [__CLASS__, 'changeLogInTitle']);
        add_action('woocommerce_after_customer_login_form', [__CLASS__, 'addLogInRegisterButton']);
        add_filter('woocommerce_my_account_my_orders_actions', [__CLASS__, 'orderAgainAction'], 10, 2);
        add_filter('woocommerce_valid_order_statuses_for_order_again', [__CLASS__, 'orderAgainStatus']);
        add_filter('woocommerce_breadcrumb_defaults', [__CLASS__, 'changeBreadcrumbDelimiter']);
        add_action('wp', [__CLASS__, 'removeDefaultOrderAgain']);
    }

    public static function registerImageSizes()
    {
        add_theme_support('woocommerce', [
            'thumbnail_image_width' => 700,
            'gallery_thumbnail_image_width' => 700,
            'single_image_width' => 700,
        ]);
    }

    public static function enableBlockEditor($canEdit, $postType)
    {
        if ($postType == 'product') {
            $canEdit = true;
        }
        return $canEdit;
    }

    public static function quantityLabel()
    {
        ?>
        <div class="quantity-label">Quantity</div>
        <?php
    }

    public static function addLogInClass($classes)
    {
        if (!is_user_logged_in() && is_account_page()) {
            $classes[] = 'woocommerce-log-in';
        }
    
        return $classes;
    }
    
    public static function changeLogInTitle($text) {
        if (!is_user_logged_in() && is_account_page()) {
            $text = str_replace('Dealer Account', 'Dealer Login', $text);
        }

        return $text;
    }

    public static function addLogInRegisterButton() 
    {
        ?>
            <div class="request-account-button wp-block-button is-style-black-outline">
                <a class="wp-block-button__link wp-element-button" href="/contact"><?php _e( 'Request a dealer account' ); ?></a>
            </div>
        <?php
    }

    public static function removeDefaultOrderAgain() 
    {
        if (is_order_received_page()) 
        {
            remove_action('woocommerce_order_details_after_order_table', 'woocommerce_order_again_button');
        }
    }

    public static function orderAgainAction($actions, $order)
    {
        // Add 'order again' button to orders table
        $actions['order-again'] = array(
            'url' => wp_nonce_url(add_query_arg( 'order_again', $order->get_id(), wc_get_cart_url() ), 'woocommerce-order_again'),
            'name' => __( 'Order again', 'woocommerce' )
        );

        return $actions;
    }
 
    public static function orderAgainStatus() 
    {
        // Array of order statuses where 'order again' button will show
        return array('pending', 'processing', 'on-hold', 'completed', 'cancelled', 'refunded', 'failed');
    }

    public static function changeBreadcrumbDelimiter($defaults) 
    {
        $defaults['delimiter'] = ' &gt; ';
        return $defaults;
    }
}

WooCommerce::init();
