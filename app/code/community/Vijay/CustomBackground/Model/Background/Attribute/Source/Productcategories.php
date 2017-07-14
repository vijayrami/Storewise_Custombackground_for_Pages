<?php
class Vijay_CustomBackground_Model_Background_Attribute_Source_Productcategories extends Varien_Object
{
    const REPEATER = '_';
    const PREFIX_END = '';
    protected $_options = array();
    /**
     * @param int $parentId
     * @param int $recursionLevel
     *
     * @return array
     */
    public function getOptionArray($parentId = 1, $recursionLevel = 3)
    {
        $recursionLevel = (int)$recursionLevel;
        $parentId       = (int)$parentId;
        $category = Mage::getModel('catalog/category');
        /* @var $category Mage_Catalog_Model_Category */
        
        //$storeCategories = $category->getCategories($parentId, $recursionLevel, TRUE, FALSE, TRUE);
		$storeCategories = $category->getCategories($parentId, $recursionLevel, TRUE, FALSE, TRUE);
		
        foreach ($storeCategories as $node) {
        	 
            /* @var $node Varien_Data_Tree_Node */
            if($node->getEntityId() == 2) {
    			$this->_options = '';
  			} else {
  				$this->_options[] = array(
                'label' => $node->getName(),
                'value' => $node->getEntityId()
            );
  			}
            
            if ($node->hasChildren()) {
                $this->_getChildOptions($node->getChildren());
            }
        }
        return $this->_options;
    }
    /**
     * @param Varien_Data_Tree_Node_Collection $nodeCollection
     */
    protected function _getChildOptions(Varien_Data_Tree_Node_Collection $nodeCollection)
    {
        foreach ($nodeCollection as $node) {
            /* @var $node Varien_Data_Tree_Node */
            $prefix = str_repeat(self::REPEATER, $node->getLevel() * 1) . self::PREFIX_END;
            $this->_options[] = array(
                'label' => $prefix . $node->getName(),
                'value' => $node->getEntityId()
            );
            if ($node->hasChildren()) {
                $this->_getChildOptions($node->getChildren());
            }
        }
    }
}