<?php

declare(strict_types=1);

namespace Training\Feedback\Controller\Index;

use Exception;
use Magento\Framework\App\ActionInterface;
use Training\Feedback\Model\FeedbackFactory;
use Training\Feedback\Model\ResourceModel\Feedback;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\RedirectFactory as ResultRedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\RequestInterface;

class Save implements ActionInterface
{
    /**
     * @var FeedbackFactory
     */
    private $feedbackFactory;

    /**
     * @var Feedback
     */
    private $feedbackResource;

    /**
     * @var ResultRedirectFactory
     */
    private $resultRedirectFactory;

    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * Save constructor.
     *
     * @param FeedbackFactory $feedbackFactory
     * @param Feedback $feedbackResource
     * @param ResultRedirectFactory $resultRedirectFactory
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        FeedbackFactory $feedbackFactory,
        Feedback $feedbackResource,
        ResultRedirectFactory $resultRedirectFactory,
        ManagerInterface $messageManager,
        RequestInterface $request
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackResource = $feedbackResource;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->messageManager = $messageManager;
        $this->request = $request;
    }


    public function execute()
    {
        $result = $this->resultRedirectFactory->create();
        if ($post = $this->request->getPostValue()) {
            try {
                $this->validatePost($post);
                $feedback = $this->feedbackFactory->create();
                $feedback->setData($post);
                $this->feedbackResource->save($feedback);
                $this->messageManager->addSuccessMessage(__('Thank you for your feedback.'));
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while processing your form. Please try again later.'));
                $result->setPath('*/*/form');
                return $result;
            }
        }
        $result->setPath('*/*/index');
        return $result;
    }

    /**
     * @param $post
     * @throws LocalizedException
     */
    private function validatePost($post)
    {
        if (!isset($post['author_name']) || trim($post['author_name']) === '') {
            throw new LocalizedException(__('Name is missing'));
        }
        if (!isset($post['message']) || trim($post['message']) === '') {
            throw new LocalizedException(__('Comment is missing'));
        }
        if (!isset($post['author_email']) || false === \strpos($post['author_email'], '@')) {
            throw new LocalizedException(__('Invalid email address'));
        }
        if (trim($this->request->getParam('hideit')) !== '') {
            throw new Exception();
        }
    }
}
