<?php

declare(strict_types=1);

namespace Training\Test\Controller\Page;

use Exception;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Controller\Page\View as MagentoView;
use Magento\Cms\Helper\Page as PageHelper;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class View extends MagentoView
{
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;

    /**
     * View constructor.
     *
     * @param Context $context
     * @param RequestInterface $request
     * @param PageHelper $pageHelper
     * @param ForwardFactory $resultForwardFactory
     * @param JsonFactory $resultJsonFactory
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        PageHelper $pageHelper,
        ForwardFactory $resultForwardFactory,
        JsonFactory $resultJsonFactory,
        PageRepositoryInterface $pageRepository
    ) {
        parent::__construct($context, $request, $pageHelper, $resultForwardFactory);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->pageRepository = $pageRepository;
    }

    public function execute()
    {
        if ($this->getRequest()->isAjax()) {
            $data = ['status' => 'success', 'message' => ''];
            $pageId = $this->getRequest()->getParam('page_id', $this->getRequest()->getParam('id', false));
            $resultJson = $this->resultJsonFactory->create();
            try {
                $page = $this->pageRepository->getById($pageId);
                $data['title'] = $page->getTitle();
                $data['content'] = $page->getContent();
            } catch (NoSuchEntityException $e) {
                $data['status'] = 'error';
                $data['message'] = 'Not found';
            } catch (Exception $e) {
                $data['status'] = 'error';
                $data['message'] = 'Something wrong';
            }
            $resultJson->setData($data);

            return $resultJson;
        }

        return parent::execute();
    }
}
