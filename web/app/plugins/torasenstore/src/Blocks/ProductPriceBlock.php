<?php

namespace RedFern\TorasenStore\Blocks;

class ProductPriceBlock
{
    public static function register()
    {
        register_block_type(TORASENSTORE_PLUGIN_DIR . "/build/blocks/product-price", [
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
		<div id="torasen-product-price" data-product-id="<?php echo $postId; ?>"></div>
        <?php
        return ob_get_clean();
    }
}
