<?php

declare(strict_types=1);

namespace Training\Feedback\Model;

use Magento\Framework\Model\AbstractModel;
use Training\Feedback\Model\ResourceModel\Feedback as ResourceFeedback;

class Feedback extends AbstractModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected function _construct()
    {
        $this->_init(ResourceFeedback::class);
    }
}
