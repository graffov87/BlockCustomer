<?php

class Chervit_Blockcustomer_Model_Customer extends Mage_Core_Model_Abstract
{
    const BLOCKCUSTOMER = 'blockcustomer';

    const LIMIT = 3;

    const LIMIT_TIME = 24;

    /**#@+
     * Codes of exceptions related to customer model
     */
    const EXCEPTION_LAST_TIME = 2;

    /**
     * Model event prefix
     *
     * @var string
     */
    protected $_eventPrefix = self::BLOCKCUSTOMER;

    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = self::BLOCKCUSTOMER;

    /**
     * List of errors
     *
     * @var array
     */
    protected $_errors = array();

    /**
     * Is model deleteable
     *
     * @var boolean
     */
    protected $_isDeleteable = true;

    /**
     * Is model readonly
     *
     * @var boolean
     */
    protected $_isReadonly = false;

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::BLOCKCUSTOMER;

    /**
     * Confirmation requirement flag
     *
     * @var boolean
     */
    private static $_isConfirmationRequired;

    /**
     * Initialize customer model
     */
    function _construct()
    {
        $this->_init('blockcustomer/customer');
    }

    /**
     * @param $customer
     * @return $this
     */
    public function loadByCustomer($customer)
    {
        $this->_getResource()->loadByCustomer($this, $customer);
        return $this;
    }

    /**
     * @param null $attempts
     * @param null $hold
     * @param null $beginDate
     *
     */
    public function saveData($attempts = null, $hold = null, $beginDate = null)
    {
        if ($attempts !== null) {
            $this->setAttempts($attempts);
        }

        if ($hold !== null) {
            $this->setHold($hold);
        }

        if ($beginDate !== null) {
            $this->setBeginDate($beginDate);
        }

        $this->save();
    }
}
