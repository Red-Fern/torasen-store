<?php

namespace RFOrigin;

class Products
{
    public static function parseProductFamily($family): \WP_Term|bool
    {
        if ($family) {
            return get_term_by('term_id', $family, 'productfamily');
        }

        $terms = wp_get_object_terms($GLOBALS['post']->ID, 'productfamily');
        if (empty($terms)) {
            return false;
        }

        return get_term_by('term_id', $terms[0]->term_id, 'productfamily');
    }
}