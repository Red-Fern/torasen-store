<?php

namespace RedFern\TorasenStore;

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
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute,
                array(
                    'fields' => 'all',
                )
            );

            $attributes[$attribute] = $terms;
        }

        $variations = $product->get_available_variations();
        $defaultAttributes = $product->get_default_attributes();

        return wp_send_json(compact('defaultAttributes', 'variations', 'attributes'));
    }
}
