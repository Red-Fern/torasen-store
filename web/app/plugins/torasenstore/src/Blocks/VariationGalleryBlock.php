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

        ob_start();
        ?>
        <div id="torasen-variation-gallery" data-product-id="<?php echo $postId; ?>"></div>
        <?php
        return ob_get_clean();
    }
}
