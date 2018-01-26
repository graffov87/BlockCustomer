<?php

class Chervit_Blockcustomer_Model_Origcustomer extends Mage_Customer_Model_Customer
{
    /**
     * @param string $login
     * @param string $password
     * @return true
     * @throws Mage_Core_Exception
     */
    public function authenticate($login, $password)
    {
        $this->loadByEmail($login);

        if (!empty($this->getId())) {
            $blockCustomer = Mage::getModel('blockcustomer/customer');
            $blockCustomer->loadByCustomer($this->getId());
            if (!$blockCustomer->getId()) {
                $blockCustomer->addData(
                    array('customer_id' => $this->getId())
                );
                $blockCustomer->save();
            }
            if (!$this->validatePassword($password)) {
                $count = $blockCustomer->getAttempts();

                if (++$count == Chervit_Blockcustomer_Model_Customer::LIMIT) {
                    $blockCustomer->saveData($count, 1, Mage::getSingleton('core/date')->date());
                    throw Mage::exception(
                        'Mage_Core',
                        Mage::helper('blockcustomer')->__('Your account is blocked for %s hours.',
                            Chervit_Blockcustomer_Model_Customer::LIMIT_TIME),
                        Chervit_Blockcustomer_Model_Customer:: EXCEPTION_LAST_TIME
                    );
                } elseif ($count > Chervit_Blockcustomer_Model_Customer::LIMIT) {
                    $interval = Mage::helper('blockcustomer')->calculateHours(
                        $blockCustomer->getBeginDate(),
                        Mage::getSingleton('core/date')->date()
                    );
                    if ($interval >= Chervit_Blockcustomer_Model_Customer::LIMIT_TIME) {
                        $blockCustomer->saveData(0, 0);
                    } else {
                        throw Mage::exception(
                            'Mage_Core',
                            Mage::helper('blockcustomer')->__('Your account is locked. Until the lock is %s hours.',
                                Chervit_Blockcustomer_Model_Customer::LIMIT_TIME - $interval),
                            Chervit_Blockcustomer_Model_Customer:: EXCEPTION_LAST_TIME
                        );
                    }
                } else {
                    $blockCustomer->saveData($count);
                }
            } else {
                $blockCustomer->saveData(0, 0);
            }
        }

        return parent::authenticate($login, $password);
    }
}
