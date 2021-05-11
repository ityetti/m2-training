<?php

declare(strict_types=1);

namespace Training\Feedback\Block;

use Magento\Framework\DataObject;
use Magento\Framework\Stdlib\DateTime\Timezone;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Theme\Block\Html\Pager;
use Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory;

class FeedbackList extends Template
{
    const PAGE_SIZE = 5;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    private $collection;

    /**
     * @var Timezone
     */
    private $timezone;

    /**
     * FeedbackList constructor.
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param Timezone $timezone
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Timezone $timezone,
        array $data = array()
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->timezone = $timezone;
    }

    /**
     * @return mixed
     */
    public function getCollection()
    {
        if (!$this->collection) {
            $this->collection = $this->collectionFactory->create();
            $this->collection->addFieldToFilter('is_active', 1);
            $this->collection->setOrder('creation_time', 'DESC');
        }
        return $this->collection;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        $pagerBlock = $this->getChildBlock('feedback_list_pager');
        if ($pagerBlock instanceof DataObject) {
            /* @var $pagerBlock Pager */
            $pagerBlock
                ->setUseContainer(false)
                ->setShowPerPage(false)
                ->setShowAmounts(false)
                ->setLimit($this->getLimit())
                ->setCollection($this->getCollection());
            return $pagerBlock->toHtml();
        }
        return '';
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return static::PAGE_SIZE;
    }

    /**
     * @return string
     */
    public function getAddFeedbackUrl()
    {
        return $this->getUrl('feedback/index/form');
    }

    /**
     * @param $feedback
     * @return false|string
     */
    public function getFeedbackDate($feedback)
    {
        return $this->timezone->formatDateTime($feedback->getCreationTime());
    }
}
