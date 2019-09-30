<?php

namespace Mitto\Core\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Mitto\Core\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getConnection()->newTable(
            $installer->getTable('mitto_core_smstemplates')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Entity ID'
        )->addColumn(
            'from',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Template Title'
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Template Title'
        )->addColumn(
            'template',
            Table::TYPE_TEXT,
            2000,
            ['nullable' => false],
            'Template'
        );
        $installer->getConnection()->createTable($table);

        $table = $installer->getConnection()->newTable(
            $installer->getTable('mitto_core_log')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Entity ID'
        )->addColumn(
            'from',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false]
        )->addColumn(
            'to',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false]
        )->addColumn(
            'to_name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false]
        )->addColumn(
            'text',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false]
        )->addColumn(
            'response_serialized',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true]
        )->addColumn(
            'response_id',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true]
        )->addColumn(
            'status',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true, 'default' => 'SENT']
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT]
        )->addColumn(
            'updated_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE]
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
