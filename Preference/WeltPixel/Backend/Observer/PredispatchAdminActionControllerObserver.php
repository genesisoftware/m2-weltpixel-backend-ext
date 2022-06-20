<?php
namespace Genesisoft\BackendExt\Preference\WeltPixel\Backend\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * PredispatchAdminActionControllerObserver observer
 *
 */
class PredispatchAdminActionControllerObserver extends \WeltPixel\Backend\Observer\PredispatchAdminActionControllerObserver
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $isNotificationEnabled = $this->_scopeConfig->getValue(self::XML_PATH_WELTPIXEL_ENABLE_ADMIN_NOTIFICATIONS);
        if ($isNotificationEnabled && $this->_backendAuthSession->isLoggedIn()) {
            $feedModel = $this->_feedFactory->create();
            /* @var $feedModel \WeltPixel\Backend\Model\Feed */
            $feedModel->checkUpdate();

            $licenseMessage = $this->wpHelper->getLicenseMessage();
            if ($licenseMessage) {
                $items = $this->messageManager->getMessages(false)->getItems();
                $errorAlreadyAdded = false;
                foreach ($items as $item) {
                    if ($item->getText() == $licenseMessage ) {
                        $errorAlreadyAdded = true;
                    }
                }

                if (!$errorAlreadyAdded) {
                    $this->messageManager->addError($licenseMessage);
                }
            }
        }

        return $this;
    }
}
