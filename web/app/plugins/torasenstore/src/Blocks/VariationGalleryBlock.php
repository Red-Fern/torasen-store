<?php

namespace RedFern\TorasenStore\Blocks;

class VariationGalleryBlock
{
    public static function register()
    {
        register_block_type(TORASENSTORE_PLUGIN_DIR . "/build/blocks/variation-gallery", [
            'render_callback' => [__CLASS__, 'render'],
        ]);
    }

    public static function render($attributes, $content, $block)
    {
        $postId = $block->context['postId'];

        if (! isset($postId)) {
            return '';
        }

        $productVideoId = get_post_meta($postId, 'product_video', true);
        $productVideoUrl = $productVideoId ? wp_get_attachment_url($productVideoId) : '';

        ob_start();
        ?>
        <div id="torasen-variation-gallery"
             data-product-id="<?php echo $postId; ?>"
             data-video="<?php echo $productVideoUrl; ?>"
        ></div>
        <?php
        return ob_get_clean();
    }
}
