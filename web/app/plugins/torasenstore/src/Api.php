<?php

namespace RedFern\TorasenStore;

use RedFern\TorasenStore\Resources\ProductAttributeResource;

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

        $variations = $product->get_available_variations();

        return wp_send_json(compact('defaultAttributes', 'variations', 'attributes', 'variationId'));
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
