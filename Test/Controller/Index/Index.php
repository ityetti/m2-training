<?php

namespace Training\Test\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\Result\RawFactory;

class Index implements ActionInterface
{
    /**
     * @var RawFactory
     */
    private $resultRawFactory;

    /**
     * Index constructor.
     *
     * @param RawFactory $resultRawFactory
     */
    public function __construct(
        RawFactory $resultRawFactory
    ) {
        $this->resultRawFactory = $resultRawFactory;
    }

    /**
     * @return ResponseInterface|Raw|ResultInterface
     */
    public function execute()
    {
        $resultRaw = $this->resultRawFactory->create();
        $resultRaw->setContents('simple text');

        return $resultRaw;
    }
}
