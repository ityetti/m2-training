<?php

declare(strict_types=1);

namespace Training\Test\Plugin\Block;

use Magento\Framework\View\Element\Template as MagentoTemplate;

class Template
{
    /**
     * @param MagentoTemplate $subject
     * @param $result
     * @return string
     */
    public function afterToHtml(MagentoTemplate $subject, $result): string
    {
        if ($subject->getNameInLayout() === 'top.search') {
            $result = '<div><p>' . $subject->getTemplate() . '</p>' . '<p>' . get_class($subject) . '</p>' . $result . '</div>';
        }

        return $result;
    }
}
