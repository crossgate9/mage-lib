<?php

class Crossgate9_Order_Ip extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Ip';
    }

    public function getValue($_options=array()) {
        $_order = $this->_entities['order'];
        $this->_values = $_order->getData('remote_ip');
        return $this->_values;
    }
}