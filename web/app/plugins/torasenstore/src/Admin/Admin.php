<?php

namespace RedFern\TorasenStore\Admin;

class Admin
{
    public static function init()
    {
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueueScripts']);

        AttributeForm::init();
        Fabrics::init();
        VariationGallery::init();
    }

    public static function enqueueScripts()
    {
        $assets = TorasenStore()->pluginPath(). 'build/admin.asset.php';
        if (file_exists($assets)) {
            $assets = require_once $assets;
            wp_enqueue_script(
                'torasenstore-admin',
                TorasenStore()->pluginUrl() . '/build/admin.js',
                $assets['dependencies'],
                $assets['version'],
                false
            );
        }
    }
}
