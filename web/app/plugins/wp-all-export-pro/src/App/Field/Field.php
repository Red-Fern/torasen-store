<?php

namespace Wpae\App\Field;

use Wpae\App\Feed\Feed;
use Wpae\App\Service\WooCommerceVersion;
use Wpae\WordPress\Filters;

abstract class Field
{
    const CUSTOM_VALUE_TEXT = 'customValue';
    const SELECT_FROM_WOOCOMMERCE_PRODUCT_ATTRIBUTES = 'selectFromWooCommerceProductAttributes';
    protected $entry;
    /**
     * @var Filters
     */
    private $filters;
    /**
     * @var Feed
     */
    protected $feed;
    /**
     * @var WooCommerceVersion
     */
    protected $wooCommerceVersion;
    /**
     * @var boolean $isCustomValue
     */

    /**
     * Field constructor.
     * @param $entry
     * @param Filters $filters
     * @param Feed $feed
     *
     */
    public function __construct($entry, Filters $filters, Feed $feed, WooCommerceVersion $wooCommerceVersion)
    {
        $this->entry = $entry;
        $this->filters = $filters;
        $this->feed = $feed;
        $this->wooCommerceVersion = $wooCommerceVersion;
    }

    public function getFieldValue($snippetData)
    {
		// Allow HTML in the description field.
        if( 'description' !== $this->getFieldName()) {
	        $value = strip_tags( $this->getValue( $snippetData ) );
        }else{
			$value = $this->getValue( $snippetData );
        }


        $functions = array();
        preg_match_all('%(\[[^\]\[]*\])%', $value, $functions);

        if (is_array($functions) && isset($functions[0]) && !empty($functions[0])) {
            foreach ($functions[0] as $function) {
                if (!empty($function)) {

                    $functionSnippet = $function;

                    $function = str_replace(array('[', ']'), '', $function);
                    $function = str_replace("('", "(\"", $function);
                    $function = str_replace("( '", "(\"", $function);
                    $function = str_replace("')", "\")", $function);
                    $function = str_replace("' )", "\")", $function);
                    $function = str_replace(array("','", "', '", "' ,'", "',\"", "\",'"), "\",\"", $function);

                    $function = $this->quoteParams($function);
                    $functionName = explode("(", $function);
                    $functionName = $functionName[0];

                    global $wpaeGoogleMerchantsFieldName;
                    $wpaeGoogleMerchantsFieldName = $this->getFieldName();

                    if (function_exists($functionName)) {
                        $functionValue = eval('return ' . $function . ';');
                    } else {
                        $functionValue = "";
                    }
                    $value = str_replace($functionSnippet, $functionValue, $value);
                }
            }
        }

        if ($this->getFieldName() == 'sale_price') {
            $availabilityPriceData = $this->feed->getSectionFeedData(SalePrice::SECTION);
            if ($value == ' ' . $availabilityPriceData['currency']) {
                $value = "";
            }

        }

        $value = str_replace("**OPENSHORTCODE**", "[", $value);
        $value = str_replace("**CLOSESHORTCODE**", "]", $value);

        $value = str_replace("**DOUBLEQUOT**", "\"", $value);
        $value = str_replace("**SINGLEQUOT**", "'", $value);

        return $value;
    }

    public function getFieldFilter()
    {
        return 'pmxe_' . $this->getFieldName();
    }

    protected function isCustomValue($value)
    {
        return $value == self::CUSTOM_VALUE_TEXT;
    }

    protected function replaceSnippetsInValue($value, $snippets)
    {

        // Replace strong tags used on the frontend
        $value = str_replace(array('<strong>', '</strong>'), '', $value);

        foreach ($snippets as $key => $snippet) {

            $snippet = str_replace("[", "**OPENSHORTCODE**", $snippet);
            $snippet = str_replace("]", "**CLOSESHORTCODE**", $snippet);

            $value = str_replace('{' . $key . '}', $snippet, $value);
        }

        return $value;
    }

    /**
     * @param array $mappings
     * @param string $value
     * @return string
     */
    protected function replaceMappings($mappings, $value)
    {
        foreach ($mappings as $mapping) {
            if (isset($mapping['mapFrom']) && isset($mapping['mapTo'])) {
                $value = str_replace($mapping['mapFrom'], $mapping['mapTo'], $value);
            }
        }
        return $value;
    }

    abstract function getFieldName();

    abstract function getValue($snippetData);

    /**
     * @param $function
     * @return mixed|string
     */
    protected function quoteParams($function)
    {
        $function = str_replace(array('" , "', '", "', '" ,"', '","'), "**BETWEENPARAMS**", $function);
        $function = str_replace(array('("', '( "'), "**BEFOREPARAMS**", $function);
        $function = str_replace(array('")', '" )'), "**AFTERPARAMS**", $function);
        $function = addslashes($function);
        $function = str_replace("**BETWEENPARAMS**", '","', $function);
        $function = str_replace("**BEFOREPARAMS**", '("', $function);
        $function = str_replace("**AFTERPARAMS**", '")', $function);

        $function = str_replace("**DOUBLEQUOT**", "\\\"", $function);
        $function = str_replace("**SINGLEQUOT**", "'", $function);

        return $function;
    }
}