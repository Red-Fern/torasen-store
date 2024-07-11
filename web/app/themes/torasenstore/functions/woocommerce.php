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
}

WooCommerce::init();
