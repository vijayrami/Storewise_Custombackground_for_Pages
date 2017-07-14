<?php
class Vijay_CustomBackground_Helper_Page extends Mage_Core_Helper_Data
{
    public function isHomePage()
    {
        $currentUrl = Mage::getUrl('*/*/*', array('_current' => true, '_use_rewrite' => true));
        $homePageUrl = Mage::getUrl('');
        return $currentUrl === $homePageUrl;
    }
    public function isProductPage()
    {
        $allowedActionNameList = array(
            'catalog_product_view',
        );
        $product = Mage::registry('current_product');
        return in_array(Mage::app()->getFrontController()->getAction()->getFullActionName(), $allowedActionNameList) && $product && $product->getId();
    }
    public function isCmsPage()
    {
        $page = Mage::getSingleton('cms/page');
        return $page->getId();
    }
    public function isCategoryPage()
    {
        $allowedActionNameList = array(
            'catalog_category_default',
            'catalog_category_layered',
            'catalog_category_view',
        );
        $category = Mage::registry('current_category');
        return in_array(Mage::app()->getFrontController()->getAction()->getFullActionName(), $allowedActionNameList) && $category && $category->getId();
    }
	public function getCurrentCategoryId() {
		return Mage::registry('current_category')->getId();
	}
    public function isCheckoutPage()
    {
        $allowedActionNameList = array(
            'checkout_onepage_index',
            'checkout_multishipping_login',
            'checkout_multishipping_index',
        );
        return in_array(Mage::app()->getFrontController()->getAction()->getFullActionName(), $allowedActionNameList);
    }
    public function isCartPage()
    {
        $allowedActionNameList = array(
            'checkout_cart_index',
        );
        return in_array(Mage::app()->getFrontController()->getAction()->getFullActionName(), $allowedActionNameList);
    }
    public function isAccountPage()
    {
        $customerAccountHandle = 'customer_account';
        if (in_array($customerAccountHandle, Mage::app()->getLayout()->getUpdate()->getHandles())) {
            return true;
        }
        $allowedActionNameList = array(
            'customer_account_logoutSuccess',
            'customer_account_login',
            'customer_account_create',
        );
        return in_array(Mage::app()->getFrontController()->getAction()->getFullActionName(), $allowedActionNameList);
    }
    public function isOtherPage()
    {
        return !$this->isHomePage() && !$this->isProductPage() && $this->isCmsPage() && !$this->isCategoryPage() && !$this->isCheckoutPage() && !$this->isCartPage() && !$this->isAccountPage();
    }
}