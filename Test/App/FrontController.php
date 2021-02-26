<?php

declare(strict_types=1);

namespace Training\Test\App;

use Magento\Framework\App\AreaList;
use Magento\Framework\App\FrontController as MagentoFrontController;
use Magento\Framework\App\Request\ValidatorInterface as RequestValidator;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterListInterface;
use Magento\Framework\App\State;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Psr\Log\LoggerInterface;

class FrontController extends MagentoFrontController
{
    /**
     * @var RouterListInterface
     */
    private $routerList;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param RouterListInterface $routerList
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     * @param RequestValidator|null $requestValidator
     * @param MessageManager|null $messageManager
     * @param State|null $appState
     * @param AreaList|null $areaList
     */
    public function __construct(
        RouterListInterface $routerList,
        ResponseInterface $response,
        LoggerInterface $logger,
        ?RequestValidator $requestValidator = null,
        ?MessageManager $messageManager = null,
        ?State $appState = null,
        ?AreaList $areaList = null
    ) {
        $this->routerList = $routerList;
        $this->response = $response;
        $this->logger = $logger;
        parent::__construct($routerList, $response, $requestValidator, $messageManager, $logger, $appState, $areaList);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface|ResultInterface|null
     * @throws LocalizedException
     */
    public function dispatch(RequestInterface $request)
    {
        foreach ($this->routerList as $router) {
            $this->logger->info(get_class($router));
        }
        return parent::dispatch($request);
    }
}
