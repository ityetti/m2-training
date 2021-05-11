<?php

declare(strict_types=1);

namespace Training\Feedback\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Feedback extends AbstractDb
{
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('training_feedback', 'feedback_id');
    }
}
