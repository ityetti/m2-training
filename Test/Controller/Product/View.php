<?php

declare(strict_types=1);

namespace Training\Test\Controller\Product;

use Magento\Catalog\Controller\Product\View as ProductView;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Helper\Product\View as HelperView;
use Psr\Log\LoggerInterface;
use Magento\Framework\Json\Helper\Data;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Customer\Model\Session;

class View extends ProductView
{
    /**
     * @var RedirectFactory
     */
    protected $redirectFactory;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * View constructor.
     *
     * @param Context $context
     * @param HelperView $viewHelper
     * @param ForwardFactory $resultForwardFactory
     * @param PageFactory $resultPageFactory
     * @param LoggerInterface|null $logger
     * @param Data|null $jsonHelper
     * @param RedirectFactory $redirectFactory
     * @param Session $customerSession
     */
    public function __construct(
        Context $context,
        HelperView $viewHelper,
        ForwardFactory $resultForwardFactory,
        PageFactory $resultPageFactory,
        LoggerInterface $logger = null,
        Data $jsonHelper = null,
        RedirectFactory $redirectFactory,
        Session $customerSession
    ) {
        parent::__construct($context, $viewHelper, $resultForwardFactory, $resultPageFactory, $logger, $jsonHelper);
        $this->redirectFactory = $redirectFactory;
        $this->customerSession = $customerSession;
    }

    /**
     * @return Forward|Redirect
     */
    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->redirectFactory->create()->setPath('customer/account/login');
        } else {
            return parent::execute();
        }
    }
}
