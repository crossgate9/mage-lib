<?php

error_reporting(E_ALL);

/**
 * �ޱ���ģ�� - class.OrderIncrement.php
 *
 * $Id$
 *
 * This file is part of �ޱ���ģ��.
 *
 * Automatically generated on 15.08.2012, 15:35:39 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * include Column
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('class.Column.php');

/* user defined includes */
// section -64--88-1-100--f4b1739:139292fa44a:-8000:000000000000086F-includes begin
// section -64--88-1-100--f4b1739:139292fa44a:-8000:000000000000086F-includes end

/* user defined constants */
// section -64--88-1-100--f4b1739:139292fa44a:-8000:000000000000086F-constants begin
// section -64--88-1-100--f4b1739:139292fa44a:-8000:000000000000086F-constants end
define('GB_STORE', '14');
define('FR_STORE', '11');
define('DE_STORE', '12');
define('US_STORE', '15');
define('DHL_AIR', 1);
define('YODEL', 3);
define('ROYAL_MAIL', 6);
define('DHL_MAIL', 10);
define('FEDEX', 20);
define('SMART_HOUSE', 30);

class Crossgate9_Order_Courier extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Courier';
    }

    private function _is_only_adaptors() {
        $_order = $this->_entities['order'];
        $_items = $_order->getAllVisibleItems();
        foreach ($_items as $_item) {
            $_product = Mage::getModel('catalog/product')->load($_item->getData('product_id'));
            $_attribute_set_id = $_product->getAttributeSetId();
            if ($_attribute_set_id != ADAPTER_ATTRIBUTE_SET_ID)
                return false;
        }
        return true;
    }
    
    private function _get_store_view() {
        $_order = $this->_entities['order'];
        return $_order->getData('store_id');
    }
    
    private function _get_full_name($_code) {
        switch ($_code) {
            case ROYAL_MAIL:
                return "Royal Mail";
            case YODEL:
                return "Yodel";
            case DHL_AIR:
                return "DHL Air";
            case DHL_MAIL:
                return "DHL Mail";
            case SMART_HOUSE:
                return "Smarting House";
            case FEDEX:
                return "Fedex";
            default:
                return "";
        }
    }
    
    /**
     * Short description of method get_value
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return string
     */
    public function getValue($_options=array())
    {
        $_type = isset($_options['type']) ? $_options['type'] : 'billing';
        $_is_full_name = isset($_options['full-name']) ? $_options['full-name'] : false;
        $_order = $this->_entities['order'];
        $_store_view = $this->_get_store_view();
        
        if ($_store_view == GB_STORE) {
            if ($this->_is_only_adaptors())
                $this->_values = ROYAL_MAIL;
            else
                $this->_values = YODEL;
        } else if ($_store_view == FR_STORE || $_store_view == DE_STORE) {
            if ($this->_is_only_adaptors())
                $this->_values = DHL_MAIL;
            else
                $this->_values = DHL_AIR;
        } else if ($_store_view == US_STORE){
            $this->_values = SMART_HOUSE;
        } else {
            $this->_values = FEDEX;
        }
        
        if ($_is_full_name)
            $this->_values = $this->_get_full_name($this->_values);
        return $this->_values;
    }

    /**
     * Short description of method set_entities
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  _entities
     * @return mixed
     */
    public function set_entities($_entities)
    {
        // section -64--88-1-100--f4b1739:139292fa44a:-8000:0000000000000876 begin
        // section -64--88-1-100--f4b1739:139292fa44a:-8000:0000000000000876 end
        $this->_entities = $_entities;
    }
    
    public function get_name() {
        return $this->_column_name;
    }

} /* end of class OrderIncrement */

?>
