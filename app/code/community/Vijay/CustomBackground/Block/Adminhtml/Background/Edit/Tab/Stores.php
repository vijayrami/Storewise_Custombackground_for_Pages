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
 * store selection tab
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Block_Adminhtml_Background_Edit_Tab_Stores extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Vijay_CustomBackground_Block_Adminhtml_Background_Edit_Tab_Stores
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setFieldNameSuffix('background');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'background_stores_form',
            array('legend' => Mage::helper('vijay_custombackground')->__('Store views'))
        );
        $field = $fieldset->addField(
            'store_id',
            'multiselect',
            array(
                'name'     => 'stores[]',
                'label'    => Mage::helper('vijay_custombackground')->__('Store Views'),
                'title'    => Mage::helper('vijay_custombackground')->__('Store Views'),
                'required' => true,
                'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            )
        );
        $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
        $field->setRenderer($renderer);
        $form->addValues(Mage::registry('current_background')->getData());
        return parent::_prepareForm();
    }
}
