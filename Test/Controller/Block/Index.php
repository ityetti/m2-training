<?php

declare(strict_types=1);

namespace Training\Test\Controller\Block;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\LayoutFactory;
use Magento\Framework\App\Response\Http;

class Index implements ActionInterface
{
    /**
     * @var LayoutFactory
     */
    private $layoutFactory;

    /**
     * @var Http
     */
    private $response;

    /**
     * @param LayoutFactory $layoutFactory
     * @param Http $response
     */
    public function __construct(
        LayoutFactory $layoutFactory,
        Http $response
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->response = $response;
    }

    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Training\Test\Block\Test');
        return $this->response->appendBody($block->toHtml());
    }
}
