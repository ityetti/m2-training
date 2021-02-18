<?php

declare(strict_types=1);

namespace Training\TestOM\Model;

class Test
{
    /**
     * @var ManagerInterface
     */
    private $manager;

    /**
     * @var array
     */
    private $arrayList;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $number;

    /**
     * @var ManagerInterfaceFactory
     */
    private $managerFactory;

    /**
     * Test constructor.
     *
     * @param ManagerInterface $manager
     * @param string $name
     * @param int $number
     * @param array $arrayList
     * @param ManagerInterfaceFactory $managerFactory
     */
    public function __construct(
        ManagerInterface $manager,
        string $name,
        int $number,
        array $arrayList,
        ManagerInterfaceFactory $managerFactory
    ) {
        $this->manager = $manager;
        $this->name = $name;
        $this->number = $number;
        $this->arrayList = $arrayList;
        $this->managerFactory = $managerFactory;
    }

    public function log()
    {
        print_r(get_class($this->manager));
        echo '<br>';
        print_r($this->name);
        echo '<br>';
        print_r($this->number);
        echo '<br>';
        print_r($this->arrayList);
        echo '<br>';
        $newManager = $this->managerFactory->create();
        print_r(get_class($newManager));
    }
}
