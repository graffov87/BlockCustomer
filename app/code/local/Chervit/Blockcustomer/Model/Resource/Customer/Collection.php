<?php

class Chervit_Blockcustomer_Model_Resource_Customer_Collection extends Mage_Eav_Model_Entity_Collection_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('blockcustomer/customer');
    }
}
