<?php

namespace RedFern\TorasenStore\Blocks;

class ProductAttributesBlock
{
    public static function register()
    {
        register_block_type(TORASENSTORE_PLUGIN_DIR . "/build/product-attributes", [
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
		<div id="torasen-product-form" data-product-id="<?php echo $postId; ?>"></div>
        <div>RENDER ATTRIBUTES HERE</div>
        <?php
        return ob_get_clean();
    }
}
