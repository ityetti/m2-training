<?php

declare(strict_types=1);

namespace Training\Test\Plugin\Model;

use Magento\Framework\UrlInterface;

class Url
{
    /**
     * @param $subject
     * @param null $routePath
     * @param null $routeParams
     * @return array
     */
    public function beforeGetUrl(
        UrlInterface $subject,
        $routePath = null,
        $routeParams = null
    ) {
        if ($routePath === 'customer/account/create') {
            return ['customer/account/login', $routeParams];
        }
    }
}
