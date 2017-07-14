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
 * Background admin edit tabs
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Block_Adminhtml_Background_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('background_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('vijay_custombackground')->__('Background'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return Vijay_CustomBackground_Block_Adminhtml_Background_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_background',
            array(
                'label'   => Mage::helper('vijay_custombackground')->__('Background'),
                'title'   => Mage::helper('vijay_custombackground')->__('Background'),
                'content' => $this->getLayout()->createBlock(
                    'vijay_custombackground/adminhtml_background_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addTab(
                'form_store_background',
                array(
                    'label'   => Mage::helper('vijay_custombackground')->__('Store views'),
                    'title'   => Mage::helper('vijay_custombackground')->__('Store views'),
                    'content' => $this->getLayout()->createBlock(
                        'vijay_custombackground/adminhtml_background_edit_tab_stores'
                    )
                    ->toHtml(),
                )
            );
        }
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve background entity
     *
     * @access public
     * @return Vijay_CustomBackground_Model_Background
     * @author Ultimate Module Creator
     */
    public function getBackground()
    {
        return Mage::registry('current_background');
    }
}
