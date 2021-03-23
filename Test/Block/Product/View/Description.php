<?php

declare(strict_types=1);

namespace Training\Test\Block\Product\View;

use Magento\Catalog\Block\Product\View\Description as MagentoDescription;

class Description
{
    /**
     * @param MagentoDescription $subject
     */
    public function beforeToHtml(MagentoDescription $subject)
    {
        $subject->setTemplate('Training_Test::description.phtml');
    }
}
