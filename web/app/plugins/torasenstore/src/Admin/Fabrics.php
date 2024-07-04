<?php

namespace RedFern\TorasenStore\Admin;

class Fabrics
{
    public static function init()
    {
        add_filter('manage_edit-pa_fabric_columns', [__CLASS__, 'columns']);
        add_filter('manage_pa_fabric_custom_column', [__CLASS__, 'columnContent'], 10, 3);
    }

    public static function columns($columns)
    {
        $columns['fabric_band'] = 'Fabric Band';
        return $columns;
    }

    public static function columnContent($content, $columnName, $termId)
    {
        switch ($columnName) {
            case 'fabric_band':
                $content = get_term_meta($termId, 'fabric_band', true);
                break;
            default:
                break;
        }

        return $content;
    }
}
