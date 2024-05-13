<?php

namespace RFOrigin;

class WooCommerce
{
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'registerImageSizes']);
    }

    public static function registerImageSizes()
    {
        add_theme_support('woocommerce', [
            'thumbnail_image_width' => 700,
            'gallery_thumbnail_image_width' => 700,
            'single_image_width' => 700,
        ]);
    }
}

WooCommerce::init();
