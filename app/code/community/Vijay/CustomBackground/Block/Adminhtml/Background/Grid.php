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
 * Background admin grid block
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Block_Adminhtml_Background_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('backgroundGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * prepare collection
     *
     * @access protected
     * @return Vijay_CustomBackground_Block_Adminhtml_Background_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('vijay_custombackground/background')
            ->getCollection();
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid collection
     *
     * @access protected
     * @return Vijay_CustomBackground_Block_Adminhtml_Background_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Id'),
                'index'  => 'entity_id',
                'type'   => 'number'
            )
        );
        $this->addColumn(
            'background_name',
            array(
                'header'    => Mage::helper('vijay_custombackground')->__('Background Name'),
                'align'     => 'left',
                'index'     => 'background_name',
            )
        );
        
        $this->addColumn(
            'status',
            array(
                'header'  => Mage::helper('vijay_custombackground')->__('Status'),
                'index'   => 'status',
                'type'    => 'options',
                'options' => array(
                    '1' => Mage::helper('vijay_custombackground')->__('Enabled'),
                    '0' => Mage::helper('vijay_custombackground')->__('Disabled'),
                )
            )
        );
        $this->addColumn(
            'background_target',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Target'),
                'index'  => 'background_target',
                'type'  => 'options',
                'options' => Mage::helper('vijay_custombackground')->convertOptions(
                    Mage::getModel('vijay_custombackground/background_attribute_source_backgroundtarget')->getAllOptions(false)
                )

            )
        );
		$this->addColumn(
            'background_custom_target',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Custom CSS selector'),
                'index'  => 'background_custom_target',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'background_target_type',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Target Type'),
                'index'  => 'background_target_type',
                'type'  => 'options',
                'options' => Mage::helper('vijay_custombackground')->convertOptions(
                    Mage::getModel('vijay_custombackground/background_attribute_source_backgroundtargettype')->getAllOptions(false)
                )

            )
        );
		$this->addColumn(
            'background_target_id',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Target Page'),
                'index'  => 'background_target_id',
                'type'  => 'text',
                )
            );
		$this->addColumn(
            'background_target_id',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Target Page'),
                'index'  => 'background_target_id',
                'type'  => 'text',
                )
        );
        $this->addColumn(
            'background_category_id',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Target Category'),
                'index'  => 'background_category_id',
                'type'  => 'text',
                'renderer'  => 'Vijay_CustomBackground_Block_Adminhtml_Renderer_CategoryName',
                )
        );
		$this->addColumn(
            'background',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background'),
            	'align'     =>'left',
                'index'  => 'background',
                'type'=> 'text',
            	'renderer'  => 'Vijay_CustomBackground_Block_Adminhtml_Renderer_Backgroundimg',

            )
        );
        /*$this->addColumn(
            'background_repeat',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Repeat'),
                'index'  => 'background_repeat',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'background_position',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Position'),
                'index'  => 'background_position',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'background_attachment',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Attachment'),
                'index'  => 'background_attachment',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'background_size',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Size'),
                'index'  => 'background_size',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'background_origin',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Origin'),
                'index'  => 'background_origin',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'background_clip',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Clip'),
                'index'  => 'background_clip',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'background_additional_style',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Background Additional Style'),
                'index'  => 'background_additional_style',
                'type'=> 'text',

            )
        );*/
        if (!Mage::app()->isSingleStoreMode() && !$this->_isExport) {
            $this->addColumn(
                'store_id',
                array(
                    'header'     => Mage::helper('vijay_custombackground')->__('Store Views'),
                    'index'      => 'store_id',
                    'type'       => 'store',
                    'store_all'  => true,
                    'store_view' => true,
                    'sortable'   => false,
                    'filter_condition_callback'=> array($this, '_filterStoreCondition'),
                )
            );
        }
        $this->addColumn(
            'created_at',
            array(
                'header' => Mage::helper('vijay_custombackground')->__('Created at'),
                'index'  => 'created_at',
                'width'  => '120px',
                'type'   => 'datetime',
            )
        );
        $this->addColumn(
            'updated_at',
            array(
                'header'    => Mage::helper('vijay_custombackground')->__('Updated at'),
                'index'     => 'updated_at',
                'width'     => '120px',
                'type'      => 'datetime',
            )
        );
        $this->addColumn(
            'action',
            array(
                'header'  =>  Mage::helper('vijay_custombackground')->__('Action'),
                'width'   => '100',
                'type'    => 'action',
                'getter'  => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('vijay_custombackground')->__('Edit'),
                        'url'     => array('base'=> '*/*/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'is_system' => true,
                'sortable'  => false,
            )
        );
        $this->addExportType('*/*/exportCsv', Mage::helper('vijay_custombackground')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('vijay_custombackground')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('vijay_custombackground')->__('XML'));
        return parent::_prepareColumns();
    }

    /**
     * prepare mass action
     *
     * @access protected
     * @return Vijay_CustomBackground_Block_Adminhtml_Background_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('background');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'=> Mage::helper('vijay_custombackground')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('vijay_custombackground')->__('Are you sure?')
            )
        );
        $this->getMassactionBlock()->addItem(
            'status',
            array(
                'label'      => Mage::helper('vijay_custombackground')->__('Change status'),
                'url'        => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'status' => array(
                        'name'   => 'status',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('vijay_custombackground')->__('Status'),
                        'values' => array(
                            '1' => Mage::helper('vijay_custombackground')->__('Enabled'),
                            '0' => Mage::helper('vijay_custombackground')->__('Disabled'),
                        )
                    )
                )
            )
        );
        $this->getMassactionBlock()->addItem(
            'background_target',
            array(
                'label'      => Mage::helper('vijay_custombackground')->__('Change Background Target'),
                'url'        => $this->getUrl('*/*/massBackgroundTarget', array('_current'=>true)),
                'additional' => array(
                    'flag_background_target' => array(
                        'name'   => 'flag_background_target',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('vijay_custombackground')->__('Background Target'),
                        'values' => Mage::getModel('vijay_custombackground/background_attribute_source_backgroundtarget')
                            ->getAllOptions(true),

                    )
                )
            )
        );
        $this->getMassactionBlock()->addItem(
            'background_target_type',
            array(
                'label'      => Mage::helper('vijay_custombackground')->__('Change Background Target Type'),
                'url'        => $this->getUrl('*/*/massBackgroundTargetType', array('_current'=>true)),
                'additional' => array(
                    'flag_background_target_type' => array(
                        'name'   => 'flag_background_target_type',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('vijay_custombackground')->__('Background Target Type'),
                        'values' => Mage::getModel('vijay_custombackground/background_attribute_source_backgroundtargettype')
                            ->getAllOptions(true),

                    )
                )
            )
        );
        return $this;
    }

    /**
     * get the row url
     *
     * @access public
     * @param Vijay_CustomBackground_Model_Background
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * get the grid url
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * after collection load
     *
     * @access protected
     * @return Vijay_CustomBackground_Block_Adminhtml_Background_Grid
     * @author Ultimate Module Creator
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    /**
     * filter store column
     *
     * @access protected
     * @param Vijay_CustomBackground_Model_Resource_Background_Collection $collection
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * @return Vijay_CustomBackground_Block_Adminhtml_Background_Grid
     * @author Ultimate Module Creator
     */
    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $collection->addStoreFilter($value);
        return $this;
    }
}
