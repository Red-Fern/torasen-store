<?php

namespace RedFern\TorasenStore;

class Taxonomies
{
    public static function init()
    {
        add_action('init', [__CLASS__, 'register']);
    }

    public static function register()
    {
        register_taxonomy('productfamily', ['product'], [
            'labels' => [
                'name'              => _x('Product Families', 'taxonomy general name', 'torasenstore'),
                'singular_name'     => _x('Product Family', 'taxonomy singular name', 'torasenstore'),
                'search_items'      => __('Search Product Families', 'torasenstore'),
                'all_items'         => __('All Product Families', 'torasenstore'),
                'parent_item'       => __('Parent Product Family', 'torasenstore'),
                'parent_item_colon' => __('Parent Product Family:', 'torasenstore'),
                'edit_item'         => __('Edit Product Family', 'torasenstore'),
                'update_item'       => __('Update Product Family', 'torasenstore'),
                'add_new_item'      => __('Add New Product Family', 'torasenstore'),
                'new_item_name'     => __('New Product Family Name', 'torasenstore'),
                'menu_name'         => __('Product Family', 'torasenstore'),
            ],
            'description' => __('Group products by their respective family', 'torasenstore'),
            'hierarchical' => true,
            'public' => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'show_in_quick_edit' => true,
            'show_admin_column' => true,
            'show_in_rest' => true
        ]);
    }
}
