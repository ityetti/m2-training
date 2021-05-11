<?php

declare(strict_types=1);

namespace Training\Feedback\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    /**
     * @var PageFactory
     */
    private $pageResultFactory;

    /**
     * Index constructor.
     *
     * @param PageFactory $pageResultFactory
     */
    public function __construct(
        PageFactory $pageResultFactory
    ) {
        $this->pageResultFactory = $pageResultFactory;
    }

    public function execute()
    {
        return $this->pageResultFactory->create();
    }
}
