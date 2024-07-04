<?php

namespace RedFern\TorasenStore\Resources;

class ProductResource
{
	protected \WC_Product $product;

	public function __construct(\WC_Product $product)
    {
        $this->product = $product;
    }

    public function toArray()
    {
        $image = wp_get_attachment_image($this->product->get_image_id(), 'medium', false);

        return [
            'id' => $this->product->get_id(),
            'name' => $this->product->get_name(),
            'thumbnail' => $this->product->get_image(),
			'link' => $this->product->get_permalink(),
            'image' => $image ?: '',
        ];
    }
}
