<?php

namespace RedFern\TorasenStore;

use RedFern\TorasenStore\Admin\AttributeForm;

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
        Blocks::init();
		Taxonomies::init();
		Api::init();

		AttributeForm::init();
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
