<?php

class Chervit_Blockcustomer_Model_Resource_Customer extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('blockcustomer/customer', 'entity_id');
    }

    /**
     * @param Chervit_Blockcustomer_Model_Customer $customer
     * @param $customer
     * @return $this
     */
    public function loadByCustomer(Chervit_Blockcustomer_Model_Customer $model, $customer)
    {
        $adapter = $this->_getReadAdapter();
        $bind    = array('customer_id' => $customer);
        $select  = $adapter->select()
            ->from($this->getTable('blockcustomer/customer'), array('entity_id'))
            ->where('customer_id = :customer_id');
        $customerId = $adapter->fetchOne($select, $bind);
        if ($customerId) {
            $this->load($model, $customerId);
        } else {
            $model->setData(array());
        }

        return $this;
    }
}
