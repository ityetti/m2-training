<?php

declare(strict_types=1);

namespace Training\Test\Controller\Block;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\LayoutFactory;
use Magento\Framework\Controller\Result\RawFactory;

class Index implements ActionInterface
{
    /**
     * @var LayoutFactory
     */
    private $layoutFactory;

    /**
     * @var RawFactory
     */
    private $resultRawFactory;

    /**
     * @param LayoutFactory $layoutFactory
     * @param RawFactory $resultRawFactory
     */
    public function __construct(
        LayoutFactory $layoutFactory,
        RawFactory $resultRawFactory
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->resultRawFactory = $resultRawFactory;
    }

    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Training\Test\Block\Test');
        $resultRaw = $this->resultRawFactory->create();
        $resultRaw->setContents($block->toHtml());

        return $resultRaw;
    }
}
