<?php

namespace RFOrigin;

class WooCommerce
{
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'registerImageSizes']);
        add_filter('use_block_editor_for_post_type', [__CLASS__, 'enableBlockEditor'], 10, 2);

        add_filter('woocommerce_resize_images', static function() {
            return false;
        });

        add_action('woocommerce_before_quantity_input_field', [__CLASS__, 'quantityLabel']);
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
}

WooCommerce::init();
