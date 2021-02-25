<?php

declare(strict_types=1);

namespace Training\Test\Observer;

use Magento\Framework\App\ActionFlag;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class RedirectToLogin implements ObserverInterface
{
    /**
     * @var RedirectInterface
     */
    private $redirect;

    /**
     * @var ActionFlag
     */
    private $actionFlag;

    /**
     * @param RedirectInterface $redirect
     * @param ActionFlag $actionFlag
     */
    public function __construct(
        RedirectInterface $redirect,
        ActionFlag $actionFlag
    ) {
        $this->redirect = $redirect;
        $this->actionFlag = $actionFlag;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $request = $observer->getEvent()->getData('request');
        if ($request->getModuleName() === 'catalog'
            && $request->getControllerName() === 'product'
            && $request->getActionName() === 'view'
        ) {
            // if ($request->getFullActionName() === 'catalog_product_view') { // altenative way
            $controller = $observer->getEvent()->getData('controller_action');
            $this->actionFlag->set('', ActionInterface::FLAG_NO_DISPATCH, true);
            $this->redirect->redirect($controller->getResponse(), 'customer/account/login');
        }
    }
}
