<?php

declare(strict_types=1);

namespace Training\Test\Block;

use Magento\Framework\View\Element\AbstractBlock;

class Test extends AbstractBlock
{
    /**
     * @return string
     */
    protected function _toHtml(): string
    {
        return "<b>Hello world from block!</b>";
    }
}
