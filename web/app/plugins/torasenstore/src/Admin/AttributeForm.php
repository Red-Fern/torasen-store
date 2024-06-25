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
        if (is_admin() && isset($_POST['attribute_help_text'])) {
            $id = isset($_GET['edit']) ? absint($_GET['edit']) : 0;
            update_option("wc_attribute_help_text-$id", stripslashes($_POST['attribute_help_text']));
        }
    }
}
