<?php

class Chervit_Blockcustomer_Block_Adminhtml_Customer_Edit extends Mage_Adminhtml_Block_Customer_Edit
{
    protected function _prepareLayout()
    {
        $customerBlock = Mage::getModel('blockcustomer/customer');
        $customerBlock->loadByCustomer($this->getCustomerId());
        if ($customerBlock->getId() && $customerBlock->getHold()) {
            if (!Mage::registry('current_customer')->isReadonly()) {
                $this->_addButton('block_customer',
                    array(
                        'label' => Mage::helper('blockcustomer')->__('Unblock Customer'),
                        'onclick' => 'setLocation(\'' . $this->getUnblockUrl() . '\')',
                        'class' => 'save',
                    ), 0);
            }
        }

        return parent::_prepareLayout();
    }

    public function getUnblockUrl()
    {
        return $this->getUrl(
            'blockcustomer/adminhtml_index/unblock',
            array('customer_id' => $this->getCustomerId())
        );
    }
}