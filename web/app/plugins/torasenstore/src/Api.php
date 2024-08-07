<?php

namespace RedFern\TorasenStore;

use RedFern\TorasenStore\Resources\ExtraFieldResource;
use RedFern\TorasenStore\Resources\ProductAttributeResource;
use RedFern\TorasenStore\Resources\ProductResource;
use SW_WAPF\Includes\Classes\Enumerable;
use SW_WAPF\Includes\Classes\Field_Groups;
use SW_WAPF\Includes\Models\FieldGroup;

class Api
{
    public static function init()
    {
        add_action('rest_api_init', [__CLASS__, 'registerRoutes']);
    }

    public static function registerRoutes()
    {
        register_rest_route('torasen/v1', '/extras/(?P<id>\d+)', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'getExtras'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('torasen/v1', '/range/(?P<id>\d+)', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'getRange'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('torasen/v1', '/variation-gallery/(?P<id>\d+)', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'getGalleryImages'],
            'permission_callback' => '__return_true',
        ]);
    }

    public static function getExtras(\WP_REST_Request $request)
    {
        if (!class_exists('SW_WAPF\Includes\Classes\Field_Groups')) {
            return wp_send_json([]);
        }

        $productId = $request->get_param('id');

        $product = wc_get_product($productId);
        $GLOBALS['product'] = $product;

        $fieldGroups = Field_Groups::get_valid_field_groups('product');
        $productFieldGroups = get_post_meta($product->get_id(), '_wapf_fieldgroup', true);
        if ($productFieldGroups) {
            array_unshift($fieldGroups, Field_Groups::process_data($productFieldGroups));
        }

        $extraFields = [];

        foreach ($fieldGroups as $fieldGroup) {
            if ($product->is_type('variable')) {
                $valids = Field_Groups::get_valid_rule_groups($fieldGroup);

                $variation_rules = [];

                foreach ($valids as $rule_group) {
                    $filtered_rules = Enumerable::from($rule_group->rules)->where(function ($rule) {
                        return $rule->subject === 'product_variation';
                    })->select(function ($rule) {
                        return [
                            'condition' => $rule->condition,
                            'values'     => Enumerable::from((array)$rule->value)->select(function ($value) {
                                return intval($value['id']);
                            })->toArray()
                        ];
                    })->toArray();

                    if (!empty($filtered_rules)) {
                        $variation_rules[] = $filtered_rules;
                    }
                }
            }

            $data = [
                'has_variation_logic'   => !empty($variation_rules),
                'variation_rules'       => $variation_rules
            ];

            foreach ($fieldGroup->fields as $field) {
                $extraFields[] = (new ExtraFieldResource($field))->toArray();
            }
        }

        wp_send_json(['fields' => $extraFields]);
    }

    public static function getRange(\WP_REST_Request $request)
    {
        $productId = $request->get_param('id');

        $productRanges = wp_get_object_terms($productId, 'productrange', array('fields' => 'all'));
        if (empty($productRanges)) {
            wp_send_json([]);
            die;
        }

        $range = $productRanges[0];
        $productCategories = wc_get_product_term_ids($productId, 'product_cat');

        $items = wc_get_products([
            'tax_query' => [
                [
                    'taxonomy' => 'productrange',
                    'field' => 'term_id',
                    'terms' => $range->term_id
                ],
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $productCategories,
                    'operator' => 'IN',
                ],
            ]
        ]);

        usort($items, function ($a, $b) use ($productId) {
            if ($a->get_id() == $productId) {
                return -1;
            }
            if ($b->get_id() == $productId) {
                return 1;
            }
            return 0;
        });

        $products = array_map(function ($product) use($productId) {
            $resource = new ProductResource($product);

            if ($product->get_id() == $productId) {
                $resource->current();
            }

            return $resource->toArray();
        }, $items);

        wp_send_json([
            'range' => $range->name,
            'description' => $range->description,
            'products' => $products,
        ]);
    }

    public static function getGalleryImages(\WP_REST_Request $request)
    {
        $variationId = $request->get_param('id');
        $product           = wc_get_product($variationId);
        $galleryImageIds = $product->get_gallery_image_ids();

        wp_send_json([
            'images' => array_map('wp_prepare_attachment_for_js', $galleryImageIds)
        ]);
    }
}
