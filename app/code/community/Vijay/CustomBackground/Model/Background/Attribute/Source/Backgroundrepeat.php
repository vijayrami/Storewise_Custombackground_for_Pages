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
 * Admin source model for Background Repeat
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Model_Background_Attribute_Source_Backgroundrepeat extends Mage_Eav_Model_Entity_Attribute_Source_Table
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
                'label' => Mage::helper('vijay_custombackground')->__('repeat'),
                'value' => 'repeat'
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('repeat-x'),
                'value' => 'repeat-x'
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('repeat-y'),
                'value' => 'repeat-y'
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('no-repeat'),
                'value' => 'no-repeat'
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('initial'),
                'value' => 'initial'
            ),
            array(
                'label' => Mage::helper('vijay_custombackground')->__('inherit'),
                'value' => 'inherit'
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
