<?php
declare(strict_types=1);

namespace PetStore\Infrastructure\Persistence\Pet;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Todo\Model\Entity\Todo;
use Todo\Model\TodoRepositoryInterface;

class DatabaseTodoRepository implements TodoRepositoryInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var ObjectRepository|EntityRepository
     */
    private $todoRepository;

    /**
     * DatabasePetRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->todoRepository = $entityManager->getRepository(Todo::class);
    }

    /**
     * @return Todo[]
     */
    public function findAll(): array
    {
        return $this->todoRepository->findAll();
    }

    /**
     * @param int $id
     * @return object|Todo
     */
    public function findById(int $id): Todo
    {
        return $this->todoRepository->find($id);
    }
}