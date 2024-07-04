<?php

namespace RFOrigin;

class Theme
{
    public static function init()
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueScripts']);
        add_filter('wp_check_filetype_and_ext', [__CLASS__, 'enableSvgUploads'], 10, 4);
        add_filter('upload_mimes', [__CLASS__, 'addSvgMimeTypes']);
        add_action('wp_body_open', [__CLASS__, 'addGtmCode'], -1);
        add_filter('body_class', [__CLASS__, 'addTermBannerClass']);
    }

    public static function enqueueScripts(): void
    {
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
    }

    public static function enableSvgUploads($data, $file, $filename, $mimes): array
    {
        $filetype = wp_check_filetype($filename, $mimes);

        return [
            'ext'             => $filetype['ext'],
            'type'            => $filetype['type'],
            'proper_filename' => $data['proper_filename']
        ];
    }

    public static function addSvgMimeTypes($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        
        return $mimes;
    }

    public static function addGtmCode()
    {
        if (in_array(getenv('WP_ENV'), ['local', 'development'])) {
            return;
        }

        if (!function_exists('gtm4wp_the_gtm_tag')) {
            return;
        }

        gtm4wp_the_gtm_tag();
    }

    public static function addTermBannerClass($classes) {
        $term = get_queried_object();
    
        if (!isset($term->taxonomy)) {
            return $classes;
        }
    
        $banner_bg = get_field('banner_bg_image', $term);
    
        // If no banner image is selected, get parent selection
        if (!$banner_bg) {
            // Get top-most parent
            $parent = get_term_by('id', $term->term_id, $term->taxonomy);
            
            while ($parent->parent != 0) {
                $parent = get_term_by('id', $parent->parent, $term->taxonomy);
            }
    
            $banner_bg = get_field('banner_bg_image', $parent);
        }
    
        $classes[] = $banner_bg;
    
        return $classes;
    }
}

Theme::init();
