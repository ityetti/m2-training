<?php

declare(strict_types=1);

namespace Training\Js\Controller\Review;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Serialize\SerializerInterface;

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
     * Index constructor.
     *
     * @param JsonFactory $jsonResultFactory
     * @param SerializerInterface $serializer
     */
    public function __construct(
        JsonFactory $jsonResultFactory,
        SerializerInterface $serializer
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        $this->serializer = $serializer;
    }

    public function execute()
    {
        $result = $this->jsonResultFactory->create();
        $result->setData($this->serializer->serialize($this->getRandomReviewData()));

        return $result;
    }

    /**
     * Get random review data
     *
     * Assume it will be retrieved from DB
     *
     * @return array
     */
    private function getRandomReviewData(): array
    {
        $reviews = [
            [
                'name' => 'Reviewer 1',
                'message' => 'Duis id mollis lectus. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Integer lacinia est sed eros viverra mattis. Integer
                    pretium nisi et libero venenatis, ac placerat orci imperdiet. In et lacus tincidunt, bibendum ipsum ac,
                    scelerisque est. Nullam ornare, neque sit amet malesuada sollicitudin.'
            ],
            [
                'name' => 'Reviewer 2',
                'message' => 'Phasellus nunc ligula, auctor quis ornare vitae, ultrices at magna. Morbi
                    bibendum id quam non posuere. Aenean molestie sit amet nisi in tempor. Morbi euismod, ante eget
                    condimentum bibendum, purus lorem posuere ipsum, nec porttitor sapien urna at sapien. Sed erat eros,
                    ultrices non dapibus sed, vehicula quis turpis. Nam.'
            ],
            [
                'name' => 'Reviewer 3',
                'message' => 'Cras a tincidunt sem. Vivamus a est id ante pulvinar hendrerit ac eget
                    lectus. Donec ac leo est. Morbi non mauris turpis. Aenean lobortis ipsum bibendum est egestas varius.
                    Sed viverra, lacus a venenatis tincidunt, massa mi tincidunt mi, at pulvinar nisl nunc non ligula.
                    Quisque posuere sed est at.'
            ],
            [
                'name' => 'Reviewer 4',
                'message' => 'Sed ac tellus pharetra, facilisis libero eu, ullamcorper tellus. Donec
                    pharetra velit ut risus lacinia, eget aliquet metus consequat. Aenean vel tincidunt quam, ac sodales
                    eros. Nunc pellentesque est vel nibh tristique, vitae ultricies ipsum ornare. Donec dictum vel justo ac
                    ultrices. Vivamus eget diam ut nibh ornare pretium ut.'
            ],
        ];

        return $reviews[rand(0, 3)];
    }
}
