<?php

namespace RFOrigin;

class Gutenberg
{
    protected static array $blocks = [
    ];

    public static function init()
    {
        add_action('init', [__CLASS__, 'registerBlockPatterns']);
        add_action('init', [__CLASS__, 'registerCustomBlockTypes']);
        add_action('enqueue_block_editor_assets', [__CLASS__, 'enqueueEditorAssets']);
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

    public static function registerCustomBlockTypes(): void
    {
        $path = get_template_directory() . '/assets/blocks/';
        
        foreach (self::$blocks as $block) {
            register_block_type($path . $block);
        }
    }

    public static function enqueueEditorAssets()
    {
        wp_enqueue_style(
            'theme-styles',
            get_template_directory_uri() . '/assets/css/main.css'
        );

        wp_enqueue_script(
            'gutenberg-scripts',
            get_template_directory_uri() . '/assets/js/gutenberg.js',
            array('wp-blocks')
        );
    }
}

Gutenberg::init();