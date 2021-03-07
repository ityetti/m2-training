<?php

declare(strict_types=1);

namespace Training\Test\App\Router;

use Magento\Framework\App\Router\NoRouteHandlerInterface;
use Magento\Framework\App\RequestInterface;

class NoRouteHandler implements NoRouteHandlerInterface
{
    /**
     * @param RequestInterface $request
     */
    public function process(RequestInterface $request)
    {
        $moduleName = 'cms';
        $controllerPath = 'index';
        $controllerName = 'index';
        $request->setModuleName($moduleName)->setControllerName($controllerPath)->setActionName($controllerName);

        return true;
    }
}
