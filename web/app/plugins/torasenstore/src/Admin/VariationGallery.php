<?php

namespace RedFern\TorasenStore\Admin;

class VariationGallery
{
    public static function init()
    {
        add_action('woocommerce_save_product_variation', [__CLASS__, 'saveVariationGallery'], 10, 2);
        add_action('wp_ajax_load_variation_gallery_media', [__CLASS__, 'loadGalleryMedia']);
    }

    public static function loadGalleryMedia()
    {
        $variationId      = absint(filter_input(INPUT_GET, 'variationId', FILTER_SANITIZE_NUMBER_INT));
        $product           = wc_get_product($variationId);
        $galleryImageIds = $product->get_gallery_image_ids();

        wp_send_json([
            'images' => array_map('wp_prepare_attachment_for_js', $galleryImageIds)
        ]);
    }

    public static function saveVariationGallery($variation_id, $i)
    {
        $image_gallery = filter_input(INPUT_POST, 'variation_media_gallery', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if ($image_gallery && isset($image_gallery[ $variation_id ])) {
            $variation = wc_get_product($variation_id);

            // Remove legacy meta field.
            $variation->delete_meta_data('variation_media_gallery');

            $gallery_image_ids = explode(',', $image_gallery[ $variation_id ]);
            $variation->set_gallery_image_ids($gallery_image_ids);

            $variation->save();
        }
    }
}
