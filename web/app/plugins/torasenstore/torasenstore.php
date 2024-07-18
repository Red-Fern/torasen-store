<?php
/**
 * Plugin Name:       Torasen Store
 * Description:       Custom functionality for Torasen Store.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Red Fern
 * Text Domain:       torasenstore
 *
 * @package torasenstore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define('TORASENSTORE_PLUGIN_FILE', __FILE__);
define('TORASENSTORE_PLUGIN_DIR', __DIR__);

$autoload = __DIR__.'/vendor/autoload.php';

if (file_exists($autoload)) {
    require_once $autoload;
}

/* Check the plugin file has been autoloaded */
if (! class_exists('RedFern\\TorasenStore\\Plugin')) {
    wp_die('Please install the TorasenStore plugin dependencies');
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	include_once __DIR__ . '/src/Import.php';
}

/* Create plugin instance */
function TorasenStore()
{
    return \RedFern\TorasenStore\Plugin::getInstance();
}

TorasenStore();
