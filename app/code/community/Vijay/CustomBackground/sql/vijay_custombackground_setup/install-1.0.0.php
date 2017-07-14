<?php
/**
 * Vijay_CustomBackground extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Vijay
 * @package        Vijay_CustomBackground
 * @copyright      Copyright (c) 2016
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * CustomBackground module install script
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Vijay Rami
 */
$this->startSetup();
$table = $this->getConnection()
    ->newTable($this->getTable('vijay_custombackground/background'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity'  => true,
            'nullable'  => false,
            'primary'   => true,
        ),
        'Background ID'
    )
    ->addColumn(
        'background_name',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable'  => false,
        ),
        'Background Name'
    )
    ->addColumn(
        'background_target',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable'  => false,
        ),
        'Background Target'
    )
	->addColumn(
        'background_custom_target',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Custom Target'
    )
    ->addColumn(
        'background_target_type',
        Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'nullable'  => false,
        ),
        'Background Target Type'
    )
    ->addColumn(
        'background_target_id',
        Varien_Db_Ddl_Table::TYPE_TEXT, '64k',
        array(),
        'Background Target Page'
    )
	->addColumn(
        'background_category_id',
        Varien_Db_Ddl_Table::TYPE_TEXT, '64k',
        array(),
        'Background Target Category'
    )
    ->addColumn(
        'background',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background'
    )
    ->addColumn(
        'background_color',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Color'
    )
    ->addColumn(
        'background_repeat',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Repeat'
    )
    ->addColumn(
        'background_position',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Position'
    )
    ->addColumn(
        'background_attachment',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Attachment'
    )
    ->addColumn(
        'background_size',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Size'
    )
    ->addColumn(
        'background_origin',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Origin'
    )
    ->addColumn(
        'background_clip',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Clip'
    )
    ->addColumn(
        'background_additional_style',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Background Additional Style'
    )
    ->addColumn(
        'status',
        Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(),
        'Enabled'
    )
    ->addColumn(
        'updated_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(),
        'Background Modification Time'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(),
        'Background Creation Time'
    ) 
    ->setComment('Background Table');
$this->getConnection()->createTable($table);
$table = $this->getConnection()
    ->newTable($this->getTable('vijay_custombackground/background_store'))
    ->addColumn(
        'background_id',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        null,
        array(
            'nullable'  => false,
            'primary'   => true,
        ),
        'Background ID'
    )
    ->addColumn(
        'store_id',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        null,
        array(
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ),
        'Store ID'
    )
    ->addIndex(
        $this->getIdxName(
            'vijay_custombackground/background_store',
            array('store_id')
        ),
        array('store_id')
    )
    ->addForeignKey(
        $this->getFkName(
            'vijay_custombackground/background_store',
            'background_id',
            'vijay_custombackground/background',
            'entity_id'
        ),
        'background_id',
        $this->getTable('vijay_custombackground/background'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey(
        $this->getFkName(
            'vijay_custombackground/background_store',
            'store_id',
            'core/store',
            'store_id'
        ),
        'store_id',
        $this->getTable('core/store'),
        'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Backgrounds To Store Linkage Table');
$this->getConnection()->createTable($table);
$this->endSetup();
