<?php

namespace RedFern\TorasenStore;

use RedFern\TorasenStore\Resources\ExtraFieldResource;
use RedFern\TorasenStore\Resources\ProductAttributeResource;
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
        register_rest_route('torasen/v1', '/attributes/(?P<id>\d+)', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'getAttributes'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('torasen/v1', '/extras/(?P<id>\d+)', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'getExtras'],
            'permission_callback' => '__return_true',
        ]);
    }

    public static function getAttributes(\WP_REST_Request $request)
    {
        $productId = $request->get_param('id');

        $product = wc_get_product($productId);

        $attributes = [];
        foreach ($product->get_variation_attributes() as $attribute => $options) {
            $attributes[$attribute] = (new ProductAttributeResource($product, $attribute))->toArray();
        }

        $defaultAttributes = $product->get_default_attributes();
        $data_store   = \WC_Data_Store::load('product');
        $variationId = $data_store->find_matching_product_variation($product, self::createAttributeMap($defaultAttributes));
        $variation    = $variationId ? $product->get_available_variation($variationId) : false;

        return wp_send_json(compact('defaultAttributes', 'variation', 'attributes'));
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

    public static function createAttributeMap($attributeArray)
    {
        $attributes = [];
        foreach ($attributeArray as $key => $value) {
            $attributes["attribute_{$key}"] = $value;
        }

        return $attributes;
    }
}
