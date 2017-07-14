<?php
class Vijay_CustomBackground_Block_Adminhtml_Renderer_CategoryName extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
        public function render(Varien_Object $row)	
	{
	        $data =  $row->getData($this->getColumn()->getIndex());
	        $id=$row->getData();
	        
	        if(isset($id['background_category_id']) && $id['background_category_id'] != '')
	        {
	                $categoryids = $id['background_category_id'];   
					$categoryarray = explode(",",$id['background_category_id']);
					foreach ($categoryarray as $category_id) {
    				$_cat = Mage::getModel('catalog/category')->setStoreId(Mage::app()->getStore()->getId())->load($category_id);
        			$categoryname .= $_cat->getName()." , ";             
    				}
				return rtrim($categoryname,' , ');
	        }
	        
	}
}

