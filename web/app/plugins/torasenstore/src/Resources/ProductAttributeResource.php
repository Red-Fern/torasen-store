<?php

namespace RedFern\TorasenStore\Resources;

class ProductAttributeResource
{
    protected int $id;
    protected \WC_Product $product;
    protected string $attribute;
    protected \WP_Taxonomy $taxonomy;

    public function __construct(\WC_Product $product, $attribute)
    {
        $this->product = $product;
        $this->attribute = $attribute;
        $this->taxonomy = get_taxonomy($attribute);
        $this->id = wc_attribute_taxonomy_id_by_name($attribute);
    }

    public function toArray()
    {
        return [
            'label' => $this->taxonomy->label,
            'name' => $this->taxonomy->name,
            'description' => $this->taxonomy->description,
            'help_text' => wpautop(get_option("wc_attribute_help_text-{$this->id}", '')),
            'options' => AttributeOptionResource::fromAttribute($this->product, $this->attribute),
        ];
    }
}
