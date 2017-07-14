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
 * Admin search model
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Model_Adminhtml_Search_Background extends Varien_Object
{
    /**
     * Load search results
     *
     * @access public
     * @return Vijay_CustomBackground_Model_Adminhtml_Search_Background
     * @author Ultimate Module Creator
     */
    public function load()
    {
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('vijay_custombackground/background_collection')
            ->addFieldToFilter('background_name', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $background) {
            $arr[] = array(
                'id'          => 'background/1/'.$background->getId(),
                'type'        => Mage::helper('vijay_custombackground')->__('Background'),
                'name'        => $background->getBackgroundName(),
                'description' => $background->getBackgroundName(),
                'url' => Mage::helper('adminhtml')->getUrl(
                    '*/custombackground_background/edit',
                    array('id'=>$background->getId())
                ),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}
