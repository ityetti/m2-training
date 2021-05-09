<?php

declare(strict_types=1);

namespace Training\Js\Controller\Qty;

use Exception;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Psr\Log\LoggerInterface;

class Index implements ActionInterface
{
    /**
     * @var JsonFactory
     */
    private $jsonResultFactory;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Index constructor.
     *
     * @param JsonFactory $jsonResultFactory
     * @param SerializerInterface $serializer
     * @param RequestInterface $request
     * @param ProductRepositoryInterface $productRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        JsonFactory $jsonResultFactory,
        SerializerInterface $serializer,
        RequestInterface $request,
        ProductRepositoryInterface $productRepository,
        LoggerInterface $logger
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        $this->serializer = $serializer;
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    public function execute()
    {
        $productId = $this->request->getParam('product_id');
        $result = $this->jsonResultFactory->create();
        try {
            $product = $this->productRepository->getById($productId);
            if ($product->getTypeId() === 'simple') {
                $stock = $product->getExtensionAttributes()->getStockItem();
                $productQty = $stock->getQty();
                $result->setData($this->serializer->serialize($productQty));
            }
        } catch (Exception $e) {
            $this->logger->debug($e->getMessage());
        }

        return $result;
    }
}
