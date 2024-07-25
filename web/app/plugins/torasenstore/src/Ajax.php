<?php

namespace RedFern\TorasenStore;

use RedFern\TorasenStore\Resources\ProductAttributeResource;

class Ajax
{
    public static function init()
    {
        add_action('wp_ajax_torasenstore_get_attributes', [__CLASS__, 'fetchAttributes']);
        add_action('wp_ajax_nopriv_torasenstore_get_attributes', [__CLASS__, 'fetchAttributes']);
    }

    public static function fetchAttributes()
    {
        $productId = $_REQUEST['product_id'];
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

    public static function createAttributeMap($attributeArray)
    {
        $attributes = [];
        foreach ($attributeArray as $key => $value) {
            $attributes["attribute_{$key}"] = $value;
        }

        return $attributes;
    }
}
