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
 * Background admin controller
 *
 * @category    Vijay
 * @package     Vijay_CustomBackground
 * @author      Ultimate Module Creator
 */
class Vijay_CustomBackground_Adminhtml_Custombackground_BackgroundController extends Vijay_CustomBackground_Controller_Adminhtml_CustomBackground
{
    /**
     * init the background
     *
     * @access protected
     * @return Vijay_CustomBackground_Model_Background
     */
    protected function _initBackground()
    {
        $backgroundId  = (int) $this->getRequest()->getParam('id');
        $background    = Mage::getModel('vijay_custombackground/background');
        if ($backgroundId) {
            $background->load($backgroundId);
        }
        Mage::register('current_background', $background);
        return $background;
    }

    /**
     * default action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title(Mage::helper('vijay_custombackground')->__('Custom Background'))
             ->_title(Mage::helper('vijay_custombackground')->__('Backgrounds'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * edit background - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $backgroundId    = $this->getRequest()->getParam('id');
        $background      = $this->_initBackground();
        if ($backgroundId && !$background->getId()) {
            $this->_getSession()->addError(
                Mage::helper('vijay_custombackground')->__('This background no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getBackgroundData(true);
        if (!empty($data)) {
            $background->setData($data);
        }
        Mage::register('background_data', $background);
        $this->loadLayout();
        $this->_title(Mage::helper('vijay_custombackground')->__('Custom Background'))
             ->_title(Mage::helper('vijay_custombackground')->__('Backgrounds'));
        if ($background->getId()) {
            $this->_title($background->getBackgroundName());
        } else {
            $this->_title(Mage::helper('vijay_custombackground')->__('Add background'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new background action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save background - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('background')) {
            try {
                $background = $this->_initBackground();
                $background->addData($data);
                $backgroundName = $this->_uploadAndGetName(
                    'background',
                    Mage::helper('vijay_custombackground/background_image')->getImageBaseDir(),
                    $data
                );
				/* Custom code start */
				if(isset($data['background_target']) && $data['background_target'] != 'custom'){
					$backgroundCustomTarget = NULL;
					$background->setData('background_custom_target', $backgroundCustomTarget);
				}
				if(isset($data['background_category_id']) && is_array($data['background_category_id'])){
					$backgroundCategoryTarget = implode(",",$data['background_category_id']);
					$background->setData('background_category_id', $backgroundCategoryTarget);
				}
				if(isset($data['background_target_type']) && ($data['background_target_type'] == '3')){
					$backgroundTargetId = NULL;
					$background->setData('background_target_id', $backgroundTargetId);
				}
				if(isset($data['background_target_type']) && ($data['background_target_type'] == '1')){
					$backgroundCategoryId = NULL;
					$background->setData('background_category_id', $backgroundCategoryId);
				}
		                if(isset($data['background_target_type']) && (($data['background_target_type'] == '5') ||($data['background_target_type'] == '7') || ($data['background_target_type'] == '6') || ($data['background_target_type'] == '4') || ($data['background_target_type'] == '2'))){
					$backgroundCategoryId = NULL;
					$background->setData('background_category_id', $backgroundCategoryId);
				}
				/* Custom code Ends */
                $background->setData('background', $backgroundName);
                $background->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vijay_custombackground')->__('Background was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $background->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                if (isset($data['background']['value'])) {
                    $data['background'] = $data['background']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setBackgroundData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                if (isset($data['background']['value'])) {
                    $data['background'] = $data['background']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_custombackground')->__('There was a problem saving the background.')
                );
                Mage::getSingleton('adminhtml/session')->setBackgroundData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('vijay_custombackground')->__('Unable to find background to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete background - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $background = Mage::getModel('vijay_custombackground/background');
                $background->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vijay_custombackground')->__('Background was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_custombackground')->__('There was an error deleting background.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('vijay_custombackground')->__('Could not find background to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete background - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $backgroundIds = $this->getRequest()->getParam('background');
        if (!is_array($backgroundIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('vijay_custombackground')->__('Please select backgrounds to delete.')
            );
        } else {
            try {
                foreach ($backgroundIds as $backgroundId) {
                    $background = Mage::getModel('vijay_custombackground/background');
                    $background->setId($backgroundId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vijay_custombackground')->__('Total of %d backgrounds were successfully deleted.', count($backgroundIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_custombackground')->__('There was an error deleting backgrounds.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $backgroundIds = $this->getRequest()->getParam('background');
        if (!is_array($backgroundIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('vijay_custombackground')->__('Please select backgrounds.')
            );
        } else {
            try {
                foreach ($backgroundIds as $backgroundId) {
                $background = Mage::getSingleton('vijay_custombackground/background')->load($backgroundId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d backgrounds were successfully updated.', count($backgroundIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_custombackground')->__('There was an error updating backgrounds.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass Background Target change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massBackgroundTargetAction()
    {
        $backgroundIds = $this->getRequest()->getParam('background');
        if (!is_array($backgroundIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('vijay_custombackground')->__('Please select backgrounds.')
            );
        } else {
            try {
                foreach ($backgroundIds as $backgroundId) {
                $background = Mage::getSingleton('vijay_custombackground/background')->load($backgroundId)
                    ->setBackgroundTarget($this->getRequest()->getParam('flag_background_target'))
                    ->setIsMassupdate(true)
                    ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d backgrounds were successfully updated.', count($backgroundIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_custombackground')->__('There was an error updating backgrounds.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass Background Target Type change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massBackgroundTargetTypeAction()
    {
        $backgroundIds = $this->getRequest()->getParam('background');
        if (!is_array($backgroundIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('vijay_custombackground')->__('Please select backgrounds.')
            );
        } else {
            try {
                foreach ($backgroundIds as $backgroundId) {
                $background = Mage::getSingleton('vijay_custombackground/background')->load($backgroundId)
                    ->setBackgroundTargetType($this->getRequest()->getParam('flag_background_target_type'))
                    ->setIsMassupdate(true)
                    ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d backgrounds were successfully updated.', count($backgroundIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_custombackground')->__('There was an error updating backgrounds.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'background.csv';
        $content    = $this->getLayout()->createBlock('vijay_custombackground/adminhtml_background_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'background.xls';
        $content    = $this->getLayout()->createBlock('vijay_custombackground/adminhtml_background_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'background.xml';
        $content    = $this->getLayout()->createBlock('vijay_custombackground/adminhtml_background_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('vijay_custombackground/background');
    }
}
