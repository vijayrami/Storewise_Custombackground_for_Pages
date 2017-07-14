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
 * Background model
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Model_Background extends Mage_Core_Model_Abstract
{
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'vijay_custombackground_background';
    const CACHE_TAG = 'vijay_custombackground_background';
	
	const TARGET_CMS = 1;
    const TARGET_PRODUCT = 2;
    const TARGET_CATEGORY = 3;
    const TARGET_CUSTOMER = 4;
    const TARGET_HOME = 5;
    const TARGET_CHECKOUT = 6;
    const TARGET_CART = 7;
	const TARGET_OTHER = 8;
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'vijay_custombackground_background';

    /**
     * Parameter name in event
     *
     * @var string
     */
    protected $_eventObject = 'background';

    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('vijay_custombackground/background');
    }

    /**
     * before save background
     *
     * @access protected
     * @return Vijay_CustomBackground_Model_Background
     * @author Ultimate Module Creator
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()) {
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }

    /**
     * save background relation
     *
     * @access public
     * @return Vijay_CustomBackground_Model_Background
     * @author Ultimate Module Creator
     */
    protected function _afterSave()
    {
        return parent::_afterSave();
    }

    /**
     * get default values
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function getDefaultValues()
    {
        $values = array();
        $values['status'] = 1;
        return $values;
    }
    
    /**
      * get Background Target Page
      *
      * @access public
      * @return array
      * @author Ultimate Module Creator
      */
    public function getBackgroundTargetId()
    {
        if (!$this->getData('background_target_id')) {
            return explode(',', $this->getData('background_target_id'));
        }
        return $this->getData('background_target_id');
    }
}
