<?php

namespace RedFern\TorasenStore;

use RedFern\TorasenStore\Admin\Admin;

class Plugin
{
    protected static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    protected function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
        add_filter('woocommerce_available_variation', [$this, 'addVariationGalleryImages'], 10, 3);
        add_filter('woocommerce_show_variation_price', '__return_true');
        add_filter('woocommerce_get_price_html', [$this, 'hidePricesForUnauthenticated'], 999, 2);

        Blocks::init();
        Taxonomies::init();
        Api::init();
        Ajax::init();

        if (is_admin()) {
            Admin::init();
        }
    }

    public static function addVariationGalleryImages($attributes, $product, $variation)
    {
        $galleryImageIds = $variation->get_gallery_image_ids();
        $attributes['galleryImages'] = array_map('wp_prepare_attachment_for_js', $galleryImageIds);

        return $attributes;
    }

    public static function hidePricesForUnauthenticated($price, $product)
    {
        if (!is_user_logged_in()) {
            return '';
        }

        return $price;
    }

    public function enqueueScripts()
    {
        $indexAssets = $this->pluginPath(). 'build/index.asset.php';
        if (file_exists($indexAssets)) {
            $assets = require_once $indexAssets;
            wp_enqueue_script(
                'torasenstore-index',
                $this->pluginUrl() . '/build/index.js',
                $assets['dependencies'],
                $assets['version'],
                false
            );

            wp_localize_script('torasenstore-index', 'torasenstore', [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('torasenstore-nonce')
            ]);
        }
    }

    public function pluginUrl()
    {
        return plugin_dir_url(TORASENSTORE_PLUGIN_FILE);
    }

    public function pluginPath()
    {
        return plugin_dir_path(TORASENSTORE_PLUGIN_FILE);
    }
}
