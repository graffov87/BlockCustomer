<?php

class Chervit_Blockcustomer_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{

    public function unblockAction()
    {
        $customer = $this->getRequest()->getParam('customer_id');
        $blockCustomer = Mage::getModel('blockcustomer/customer');
        $blockCustomer->loadByCustomer($customer);
        $blockCustomer->saveData(0, 0);
        $this->_redirect('adminhtml/customer/edit', array('id' => $customer));
    }

    protected function _isAllowed()
    {
        return true;
    }

}