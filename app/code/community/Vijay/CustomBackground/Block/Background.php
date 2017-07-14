<?php
class Vijay_CustomBackground_Block_Background extends Mage_Core_Block_Template
{
    
    public function getBackground()
    {
        if(!$this->getData('current_vijay_custombackground')){
        	if (Mage::helper('vijay_custombackground/page')->isCmsPage() && !Mage::helper('vijay_custombackground/page')->isHomePage()) {
            $background = Mage::getModel('vijay_custombackground/background')
                        ->getCollection()
                        ->addFieldToFilter('status',1)
                        ->addStoreFilter(Mage::app()->getStore())
                        ->addFieldToFilter('background_target_type',Vijay_CustomBackground_Model_Background::TARGET_CMS)
                        ->addFieldToFilter('background_target_id',array('regexp'=>'(^|,)'.Mage::getSingleton('cms/page')->getIdentifier().'(,|$)'))
                        ->getFirstItem();						
        } else {
        	$background = Mage::helper('vijay_custombackground')->getCurrentBackground();
        }
            
            $this->setData('current_vijay_custombackground',$background);
        }
        return $this->getData('current_vijay_custombackground');
    }
            
    public function canShow() {
    	if (!$this->getConfig()->isEnabled()) {
            return false;
        } else {
        	return true;
        }
  	}
	
    public function isBackgroundNeeded()
    {
        return (bool)$this->getBackground();
    }
   	
	public function getStyleOptions(){
        $result = array();
        $background = $this->getBackground();
        if(strlen($background->getBackgroundColor())){
            $result['backgroundColor'] = $background->getBackgroundColor();
        }
        
        if(strlen($background->getBackground())){
            $result['backgroundImage'] = 'url('.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'background/image'.$background->getBackground().')';
        }
            
       /*if($background->getRepeatX() && $background->getRepeatY()){
            $result['backgroundRepeat'] = 'repeat';
        } elseif($background->getRepeatX()){
            $result['backgroundRepeat'] = 'repeat-x';
        } elseif($background->getRepeatY()){
            $result['backgroundRepeat'] = 'repeat-y';
        }*/
        if($background->getBackgroundRepeat()){
            $result['backgroundRepeat'] = $background->getBackgroundRepeat();
        }
        
		if($background->getBackgroundPosition()){
            $result['backgroundPosition'] = $background->getBackgroundPosition();
        }
		
		if($background->getBackgroundAttachment()){
            $result['backgroundAttachment'] = $background->getBackgroundAttachment();
        }
		
		if($background->getBackgroundSize()){
            $result['backgroundSize'] = $background->getBackgroundSize();
        }
		
		if($background->getBackgroundOrigin()){
            $result['backgroundOrigin'] = $background->getBackgroundOrigin();
        }
		
		if($background->getBackgroundClip()){
            $result['backgroundClip'] = $background->getBackgroundClip();
        }
		
         if(strlen($background->getBackgroundAdditionalStyle())){
             foreach(explode(';',$background->getBackgroundAdditionalStyle()) as $pair){
                 if(!stristr($pair, ':'))
                         continue;
                 list($key,$value) = explode(':',$pair);
                 $result[$key] = $value;
             }
         }
         return $result;
    }

    public function getTargetElement()
    {
        $background = $this->getBackground();
		
		if ($background->getBackgroundTarget() == 'custom'){
			return $background->getBackgroundCustomTarget();
		} else {
			return $background->getBackgroundTarget();
		}
    }
	
	 /**
     * @return Vijay_CustomBackground_Helper_Config
     */
    public function getConfig()
    {
        return Mage::helper('vijay_custombackground/config');
    }
	
}

