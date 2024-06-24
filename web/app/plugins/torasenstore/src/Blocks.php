<?php

namespace RedFern\TorasenStore;

use RedFern\TorasenStore\Blocks\ProductAttributesBlock;

class Blocks
{
    protected static $blocks = [
    ];

    public static function init()
    {
        add_action('init', [__CLASS__, 'registerBlocks']);
    }

    /**
     * Registers the block using the metadata loaded from the `block.json` file.
     * Behind the scenes, it registers also all assets so they can be enqueued
     * through the block editor in the corresponding context.
     *
     * @see https://developer.wordpress.org/reference/functions/register_block_type/
     */
    public static function registerBlocks()
    {
        ProductAttributesBlock::register();

        foreach (self::$blocks as $block) {
            register_block_type(TORASENSTORE_PLUGIN_DIR . "/build/{$block}");
        }
    }
}
