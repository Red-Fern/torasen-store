<?php

namespace RedFern\TorasenStore\Resources;

class AttributeOptionResource
{
    protected \WP_Term $resource;

    public function __construct(\WP_Term $option)
    {
        $this->resource = $option;
    }

    public static function fromAttribute(\WC_Product $product, string $attribute)
    {
        $options = wc_get_product_terms(
            $product->get_id(),
            $attribute,
            array(
                'fields' => 'all',
            )
        );

        $tmp = [];
        foreach ($options as $option) {
            $tmp[] = (new static($option))->toArray();
        }

        return $tmp;
    }

    public function toArray()
    {
        return [
            'id' => $this->term_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'taxonomy' => $this->taxonomy,
            'description' => $this->description,
        ];
    }

    public function __get($name)
    {
        return property_exists($this->resource, $name) ? $this->resource->$name : null;
    }
}
