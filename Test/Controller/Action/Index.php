<?php

namespace Training\Test\Controller\Action;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;

class Index implements ActionInterface
{
    /**
     * @var RawFactory
     */
    private $resultRawFactory;

    /**
     * @var LayoutFactory
     */
    private $layoutFactory;

    /**
     * Index constructor.
     *
     * @param RawFactory $resultRawFactory
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(
        RawFactory $resultRawFactory,
        LayoutFactory $layoutFactory
    ) {
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
    }

    /**
     * @return ResponseInterface|Raw|ResultInterface
     */
    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Training\Test\Block\Test');
        $block->setTemplate('test.phtml');
        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents($block->toHtml());
    }
}
