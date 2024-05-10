<?php

namespace RFOrigin;

class Gutenberg
{
    protected static array $blocks = [
    ];

    public static function init()
    {
        add_action('init', [__CLASS__, 'registerBlockPatterns']);
        add_action('init', [__CLASS__, 'registerCustomBlocks']);
        add_action('enqueue_block_assets', [__CLASS__, 'enqueueEditorAssets']);
    }

    public static function registerBlockPatterns()
    {
        remove_theme_support('core-block-patterns');

        register_block_pattern_category(
            'content',
            [
                'label' => 'Content'
            ]
        );
    }

    public static function registerCustomBlocks()
    {
        $path = get_template_directory() . '/assets/gutenberg/blocks/';

        foreach (self::getBlocks() as $block) {
            // Retrieve the section after the forward slash from the $slug
            $blockName = substr($block, strpos($block, '/') + 1);

            register_block_type($path . $blockName);
        }
    }

    public static function enqueueEditorAssets()
    {
        if (is_admin()) {
            wp_enqueue_style(
                'theme-styles',
                get_template_directory_uri() . '/assets/css/main.css'
            );

            wp_enqueue_script(
                'theme-scripts',
                get_stylesheet_directory_uri() . '/assets/js/main.js',
                [],
                null,
                true
            );

            wp_enqueue_script(
                'gutenberg-scripts',
                get_template_directory_uri() . '/assets/js/gutenberg.js',
                array('wp-blocks', 'wp-dom'),
                time(),
                true
            );
        }
    }

    public static function getBlocks()
    {
        return apply_filters('rf_origin_gutenberg_blocks', self::$blocks);
    }
}

Gutenberg::init();