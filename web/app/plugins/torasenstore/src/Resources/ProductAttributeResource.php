<?php

namespace RedFern\TorasenStore\Resources;

class ProductAttributeResource
{
    protected \WC_Product $product;
    protected string $attribute;
    protected \WP_Taxonomy $taxonomy;

    public function __construct(\WC_Product $product, $attribute)
    {
        $this->product = $product;
        $this->attribute = $attribute;
        $this->taxonomy = get_taxonomy($attribute);
    }

    public function toArray()
    {
        return [
            'label' => $this->taxonomy->label,
			'name' => $this->taxonomy->name,
            'description' => $this->taxonomy->description,
            'options' => AttributeOptionResource::fromAttribute($this->product, $this->attribute),
        ];
    }
}
