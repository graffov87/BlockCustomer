<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Create table 'blockcustomer/customer'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('blockcustomer/customer'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Entity Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ), 'Entity Id')
    ->addColumn('begin_date', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => false,
    ), 'Begin Date')
    ->addColumn('hold', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Hold')
    ->addColumn('attempts', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => false,
        'nullable' => false,
        'default' => '0',
    ), 'Attempts')
    ->addForeignKey($installer->getFkName('blockcustomer/customer', 'customer_id', 'customer/entity', 'entity_id'),
        'customer_id', $installer->getTable('customer/entity'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Customer Blocks');
$installer->getConnection()->createTable($table);

$installer->endSetup();
