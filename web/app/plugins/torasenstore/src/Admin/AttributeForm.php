<?php

namespace RedFern\TorasenStore\Admin;

class AttributeForm
{
    public static function init()
    {
        add_action('woocommerce_after_edit_attribute_fields', [__CLASS__, 'addHelpField']);
        add_action('woocommerce_attribute_updated', [__CLASS__, 'saveHelpField'], 10, 3);
    }

    public static function addHelpField()
    {
        $id = isset($_GET['edit']) ? absint($_GET['edit']) : 0;
        $value = $id ? get_option("wc_attribute_help_text-$id") : '';

        ?>
        <tr>
            <th>Display Type</th>
            <td>
                <select name="attribute_display_type" id="attribute_display_type">
                    <option value="single" <?php selected('single', get_option("wc_attribute_display_type-$id")); ?>>Single</option>
                    <option value="grouped" <?php selected('grouped', get_option("wc_attribute_display_type-$id")); ?>>Grouped</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Help Text</th>
            <td>
                <?php wp_editor($value, 'torasen-attribute-content', [
                    'textarea_name' => 'attribute_help_text',
                    'textarea_rows' => 10,
                    'wpautop' => true,
                ]); ?>
            </td>
        </tr>
        <?php
    }

    public static function saveHelpField($id, $data, $old_slug)
    {
        if (!is_admin()) {
            return;
        }

        $id = isset($_GET['edit']) ? absint($_GET['edit']) : 0;

        if (isset($_POST['attribute_help_text'])) {
            update_option("wc_attribute_help_text-$id", stripslashes($_POST['attribute_help_text']));
        }

        if (isset($_POST['attribute_display_type'])) {
            update_option("wc_attribute_display_type-$id", stripslashes($_POST['attribute_display_type']));
        }
    }
}
