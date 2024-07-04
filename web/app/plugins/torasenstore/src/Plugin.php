<?php

namespace RedFern\TorasenStore;

use RedFern\TorasenStore\Admin\AttributeForm;
use RedFern\TorasenStore\Admin\Fabrics;

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

        Blocks::init();
        Taxonomies::init();
        Api::init();

        AttributeForm::init();
		Fabrics::init();
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
