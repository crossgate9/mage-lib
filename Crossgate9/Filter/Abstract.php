<?php 

abstract class Crossgate9_Filter_Abstract {
    protected $_collection = null;
    protected $_conditions = array();
    protected $_pageSize = null;
    
    public function addCondition($_field, $_condition) {
        $this->_conditions[$_field][] = $_condition;
    }

    public function setCollection($_collection) {
        $this->_collection = $_collection;
    }

    public function setPageSize($_pageSize) {
        if ($_pageSize === 0) return;
        $this->_pageSize = $_pageSize;
    }

    public function getCollection($_curPage = 1) {
        $_collection = $this->_collection;
        foreach ($this->_conditions as $_field => $_conditions) {
            foreach ($_conditions as $_condition) {
                $_collection->addAttributeToFilter($_field, $_condition);
            }
        }
        if ($this->_pageSize !== null) {
            $_collection->setPageSize($this->_pageSize);
            $_collection->setCurPage($_curPage);
        }
        return $_collection;
    }

    public function count() {
        $_collection = $this->getCollection();
        return count($_collection);
    }

    public function walk($_func, $_args) {
        $_collection = $this->_collection;
        foreach ($this->_conditions as $_field => $_conditions) {
            foreach ($_conditions as $_condition) {
                $_collection -> addAttributeToFilter($_field, $_condition);
            }
        }

        Mage::getSingleton('core/resource_iterator')->walk(
            $_collection->getSelect(),
            array($_func),
            $_args
        );
    }
}