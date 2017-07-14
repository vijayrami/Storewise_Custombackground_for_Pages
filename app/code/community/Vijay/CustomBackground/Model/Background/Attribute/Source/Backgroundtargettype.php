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
 * Admin source model for Background Target Type
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Model_Background_Attribute_Source_Backgroundtargettype extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
    /**
     * get possible values
     *
     * @access public
     * @param bool $withEmpty
     * @param bool $defaultValues
     * @return array
     * @author Ultimate Module Creator
     */
    public function getAllOptions($withEmpty = true, $defaultValues = false)
    {
        $options =  array(
            array(
                'label' => Mage::helper('vijay_custombackground')->__('CMS'),
                'value' => 1
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Product View'),
                'value' => 2
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Category View'),
                'value' => 3
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Customer Pages'),
                'value' => 4
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Home Page'),
                'value' => 5
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Checkout'),
                'value' => 6
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Cart'),
                'value' => 7
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('Other Page'),
                'value' => 8
            ),
        );
        if ($withEmpty) {
            array_unshift($options, array('label'=>'', 'value'=>''));
        }
        return $options;

    }

    /**
     * get options as array
     *
     * @access public
     * @param bool $withEmpty
     * @return string
     * @author Ultimate Module Creator
     */
    public function getOptionsArray($withEmpty = true)
    {
        $options = array();
        foreach ($this->getAllOptions($withEmpty) as $option) {
            $options[$option['value']] = $option['label'];
        }
        return $options;
    }

    /**
     * get option text
     *
     * @access public
     * @param mixed $value
     * @return string
     * @author Ultimate Module Creator
     */
    public function getOptionText($value)
    {
        $options = $this->getOptionsArray();
        if (!is_array($value)) {
            $value = explode(',', $value);
        }
        $texts = array();
        foreach ($value as $v) {
            if (isset($options[$v])) {
                $texts[] = $options[$v];
            }
        }
        return implode(', ', $texts);
    }
}
