<?php

namespace RedFern\TorasenStore\Resources;

use SW_WAPF\Includes\Models\Field;

class ExtraFieldResource
{
    protected Field $field;

    public function __construct(Field $field)
    {
        $this->field = $field;
    }

    public function toArray()
    {
        return [
            'id' => $this->field->id,
            'name' => $this->field->label,
            'type' => $this->field->type,
            'options' => $this->field->options['choices'] ?? [],
        ];
    }
}
