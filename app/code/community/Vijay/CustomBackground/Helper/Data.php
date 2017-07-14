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
 * CustomBackground default helper
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * convert array to options
     *
     * @access public
     * @param $options
     * @return array
     * @author Ultimate Module Creator
     */
    public function convertOptions($options)
    {
        $converted = array();
        foreach ($options as $option) {
            if (isset($option['value']) && !is_array($option['value']) &&
                isset($option['label']) && !is_array($option['label'])) {
                $converted[$option['value']] = $option['label'];
            }
        }
        return $converted;
    }
	public function getCurrentBackground()
    {
    	if ($this->getPageHelper()->isHomePage()) {
            $background = Mage::getModel('vijay_custombackground/background')
                        ->getCollection()
                        ->addStoreFilter(Mage::app()->getStore())
                        ->addFieldToFilter('status',1)
                        ->addFieldToFilter('background_target_type',Vijay_CustomBackground_Model_Background::TARGET_HOME)
                        ->getFirstItem();
        }
		if ($this->getPageHelper()->isCmsPage() && !$this->getPageHelper()->isHomePage()) {
            $background = Mage::getModel('vijay_custombackground/background')
                        ->getCollection()
                        ->addFieldToFilter('status',1)
                        ->addStoreFilter(Mage::app()->getStore())
                        ->addFieldToFilter('background_target_type',Vijay_CustomBackground_Model_Background::TARGET_CMS)
                        ->addFieldToFilter('background_target_id',array('regexp'=>'(^|,)'.Mage::getSingleton('cms/page')->getIdentifier().'(,|$)'))
                        ->getFirstItem();
						
        }
		if ($this->getPageHelper()->isCategoryPage()) {
            $background = Mage::getModel('vijay_custombackground/background')
                        ->getCollection()
                        ->addStoreFilter(Mage::app()->getStore())
                        ->addFieldToFilter('status',1)
                        ->addFieldToFilter('background_target_type',Vijay_CustomBackground_Model_Background::TARGET_CATEGORY)
                        ->getFirstItem();
			$backgroundCategories = $background->getBackgroundCategoryId();
			$bgarray = explode(",",$backgroundCategories);
	
			$curcategoryId = $this->getPageHelper()->getCurrentCategoryId();
			if (!in_array($curcategoryId, $bgarray)){
				$background = '';
			}
			
        }
		if ($this->getPageHelper()->isProductPage()) {
            $background = Mage::getModel('vijay_custombackground/background')
                        ->getCollection()
                        ->addStoreFilter(Mage::app()->getStore())
                        ->addFieldToFilter('status',1)
                        ->addFieldToFilter('background_target_type',Vijay_CustomBackground_Model_Background::TARGET_PRODUCT)
                        ->getFirstItem();
        }
		if ($this->getPageHelper()->isCheckoutPage()) {
            $background = Mage::getModel('vijay_custombackground/background')
                        ->getCollection()
                        ->addStoreFilter(Mage::app()->getStore())
                        ->addFieldToFilter('status',1)
                        ->addFieldToFilter('background_target_type',Vijay_CustomBackground_Model_Background::TARGET_CHECKOUT)
                        ->getFirstItem();
        }
        if ($this->getPageHelper()->isCartPage()) {
            $background = Mage::getModel('vijay_custombackground/background')
                        ->getCollection()
                        ->addStoreFilter(Mage::app()->getStore())
                        ->addFieldToFilter('status',1)
                        ->addFieldToFilter('background_target_type',Vijay_CustomBackground_Model_Background::TARGET_CART)
                        ->getFirstItem();
        }
		if ($this->getPageHelper()->isAccountPage()) {
            $background = Mage::getModel('vijay_custombackground/background')
                        ->getCollection()
                        ->addStoreFilter(Mage::app()->getStore())
                        ->addFieldToFilter('status',1)
                        ->addFieldToFilter('background_target_type',Vijay_CustomBackground_Model_Background::TARGET_CUSTOMER)
                        ->getFirstItem();
        }
		if ($this->getPageHelper()->isOtherPage()) {
            $background = Mage::getModel('vijay_custombackground/background')
                        ->getCollection()
                        ->addStoreFilter(Mage::app()->getStore())
                        ->addFieldToFilter('status',1)
                        ->addFieldToFilter('background_target_type',Vijay_CustomBackground_Model_Background::TARGET_OTHER)
                        ->getFirstItem();
        }
		
		return $background;
    }
	/**
     * @return Vijay_CustomBackground_Helper_Page
     */
    public function getPageHelper()
    {
        return Mage::helper('vijay_custombackground/page');
    }
}
