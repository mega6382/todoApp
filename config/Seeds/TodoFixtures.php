<?php
declare(strict_types=1);

namespace MyDataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Todo\Model\Entity\Todo;

class TodoFixtureLoader extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $todo1 = new Todo();
        $todo1->setTitle("Example Todo 1");
        $todo1->setDone(false);
        $manager->persist($todo1);

        $todo2 = new Todo();
        $todo2->setTitle("Example Todo 2");
        $todo2->setDone(true);
        $manager->persist($todo1);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return int
     */
    public function getOrder(): int
    {
        return 1;
    }
}