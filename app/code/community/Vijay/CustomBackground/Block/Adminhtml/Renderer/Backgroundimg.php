<?php
class Vijay_CustomBackground_Block_Adminhtml_Renderer_Backgroundimg extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{	
	public function render(Varien_Object $row)	
	{
		$data =  $row->getData($this->getColumn()->getIndex());
		$id=$row->getData();
		if(isset($id['background']) && $id['background'] != '')
		{
		   $value='<center>  <img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'/background/image/'.$data.'" width="150" height="100" /> <br> <a href="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'/background/image/'.$data.'" class="openbgimg" > Show Photo </a></center>';
		return $value;        
		}
		
	}
}



