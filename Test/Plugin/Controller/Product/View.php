<?php

declare(strict_types=1);

namespace Training\Test\Plugin\Controller\Product;

use Magento\Customer\Model\Session;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Catalog\Controller\Product\View as MagentoView;
use Closure;
use Magento\Framework\Controller\Result\Redirect;

class View
{
    /**
     * @var Session
     */
    private $customerSession;

    /**
     * @var RedirectFactory
     */
    private $redirectFactory;

    /**
     * View constructor.
     *
     * @param Session $customerSession
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        Session $customerSession,
        RedirectFactory $redirectFactory
    ) {
        $this->customerSession = $customerSession;
        $this->redirectFactory = $redirectFactory;
    }

    /**
     * @param MagentoView $subject
     * @param Closure $proceed
     * @return Closure|Redirect
     */
    public function aroundExecute(
        MagentoView $subject,
        Closure $proceed
    ) {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->redirectFactory->create()->setPath('customer/account/login');
        }

        return $proceed();
    }
}
