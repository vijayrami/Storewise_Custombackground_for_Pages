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
 * Background edit form tab
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Block_Adminhtml_Background_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Vijay_CustomBackground_Block_Adminhtml_Background_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('background_');
        $form->setFieldNameSuffix('background');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'background_form',
            array('legend' => Mage::helper('vijay_custombackground')->__('Background'))
        );
        $fieldset->addType(
            'image',
            Mage::getConfig()->getBlockClassName('vijay_custombackground/adminhtml_background_helper_image')
        );

        $fieldset->addField(
            'background_name',
            'text',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Name'),
                'name'  => 'background_name',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'background_target',
            'select',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Target'),
                'name'  => 'background_target',
                'required'  => true,
                'class' => 'required-entry',

                'values'=> Mage::getModel('vijay_custombackground/background_attribute_source_backgroundtarget')->getAllOptions(true),
           )
        );
		
		$fieldset->addField(
            'background_custom_target',
            'text',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Custom CSS selector'),
                'name'  => 'background_custom_target',
                'required'  => false,
                'note'=>'Input CSS selector, like .class or #id',
           )
        );
			
        $typefield = $fieldset->addField(
            'background_target_type',
            'select',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Target Type'),
                'name'  => 'background_target_type',
                'required'  => true,
                'class' => 'required-entry',

                'values'=> Mage::getModel('vijay_custombackground/background_attribute_source_backgroundtargettype')->getAllOptions(true),
                'onchange' => 'onchangeStyleShow(this.value)',
           )
           
        );
		
		$typefield->setAfterElementHtml("<script type=\"text/javascript\">
            function onchangeStyleShow(e){
                if (e == 3){
                	$('background_background_category_id').toggleClassName('required-entry');
                } else if (e == 1) {
                    $('background_background_target_id').toggleClassName('required-entry');
                }
            }
        </script>");
		
						
		$options = $collection = Mage::getModel('cms/page')
                    ->getCollection()
                    ->addFieldToFilter('identifier',
						array(
                        		array('neq' => 'home'),// add your custome identifier name for home page
                    	)
					)
					->addFieldToFilter('is_active',1)
                    ->toOptionArray();
					
        $fieldset->addField(
            'background_target_id',
            'multiselect',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Target Page'),
                'name'  => 'background_target_id',
                'values'=> $options,
           )
        );
		
		$fieldset->addField(
            'background_category_id',
            'multiselect',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Target Category'),
                'name'  => 'background_category_id',
                'values'   => Mage::getModel('vijay_custombackground/background_attribute_source_productcategories')->getOptionArray(),
           )
        );

        $fieldset->addField(
            'background',
            'image',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background'),
                'name'  => 'background',
                'required'  => true,
                'class' => 'required-entry required-file',

           )
        )->setAfterElementHtml("<small>Allowed .jpg, .jpeg, .gif and .png File Extensions.</small><script type=\"text/javascript\">
        var imgvalue = $('background_background').readAttribute('value');
		if(!imgvalue){
			$('background_background').addClassName('required-entry');
		}
        </script>");;
		
		$this->setChild(
		'form_after', 
		$this->getLayout()
	        ->createBlock('adminhtml/widget_form_element_dependence')
	        ->addFieldMap('background_background_target_type', 'background_target_type')
	        ->addFieldMap('background_background_target_id', 'background_target_id')
	        ->addFieldDependence('background_target_id', 'background_target_type', 1)
			->addFieldMap('background_background_target_type', 'background_target_type')
	        ->addFieldMap('background_background_category_id', 'background_category_id')
	        ->addFieldDependence('background_category_id', 'background_target_type', 3)
			->addFieldMap('background_background_target', 'background_background_target')
	        ->addFieldMap('background_background_custom_target', 'background_background_custom_target')
	        ->addFieldDependence('background_background_custom_target', 'background_background_target', 'custom')
		);
        $fieldset->addField(
            'background_color',
            'text',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Color'),
                'name'  => 'background_color',
                'class' => 'color {required:true, adjust:true, hash:true} validate-hex'

           )
        );

        $fieldset->addField(
            'background_repeat',
            'select',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Repeat'),
                'name'  => 'background_repeat',
                'values'=> Mage::getModel('vijay_custombackground/background_attribute_source_backgroundrepeat')->getAllOptions(true),

           )
        );

        $fieldset->addField(
            'background_position',
            'select',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Position'),
                'name'  => 'background_position',
                'values'=> Mage::getModel('vijay_custombackground/background_attribute_source_backgroundposition')->getAllOptions(true),

           )
        );

        $fieldset->addField(
            'background_attachment',
            'select',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Attachment'),
                'name'  => 'background_attachment',
                'values'=> Mage::getModel('vijay_custombackground/background_attribute_source_backgroundattachment')->getAllOptions(true),

           )
        );

        $fieldset->addField(
            'background_size',
            'select',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Size'),
                'name'  => 'background_size',
                'values'=> Mage::getModel('vijay_custombackground/background_attribute_source_backgroundsize')->getAllOptions(true),

           )
        );

        $fieldset->addField(
            'background_origin',
            'select',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Origin'),
                'name'  => 'background_origin',
                'values'=> Mage::getModel('vijay_custombackground/background_attribute_source_backgroundorigin')->getAllOptions(true),

           )
        );

        $fieldset->addField(
            'background_clip',
            'select',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Clip'),
                'name'  => 'background_clip',
				'values'=> Mage::getModel('vijay_custombackground/background_attribute_source_backgroundclip')->getAllOptions(true),
           )
        );

        $fieldset->addField(
            'background_additional_style',
            'text',
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Background Additional Style'),
                'name'  => 'background_additional_style',

           )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('vijay_custombackground')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('vijay_custombackground')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('vijay_custombackground')->__('Disabled'),
                    ),
                ),
            )
        );
        if (Mage::app()->isSingleStoreMode()) {
            $fieldset->addField(
                'store_id',
                'hidden',
                array(
                    'name'      => 'stores[]',
                    'value'     => Mage::app()->getStore(true)->getId()
                )
            );
            Mage::registry('current_background')->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $formValues = Mage::registry('current_background')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getBackgroundData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getBackgroundData());
            Mage::getSingleton('adminhtml/session')->setBackgroundData(null);
        } elseif (Mage::registry('current_background')) {
            $formValues = array_merge($formValues, Mage::registry('current_background')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
