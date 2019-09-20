<?php

namespace Todo\Controller;

use Doctrine\ORM\EntityManager;
use PetStore\Infrastructure\Persistence\Pet\DatabaseTodoRepository;
use Todo\Model\Entity\Todo;
use Todo\Model\TodoRepositoryInterface;

class TodoController
{
    /**
     * @var EntityManager
     */
    private $entitiManager;
    /**
     * @var TodoRepositoryInterface
     */
    private $todoRepository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entitiManager = $entityManager;
        $this->todoRepository = new DatabaseTodoRepository($entityManager);
    }

    public function listAction(): string
    {
        return json_encode($this->todoRepository->findAll());
    }

    public function addAction(array $data): string
    {
        $todo = new Todo();
        $title = isset($data['title']) ? $data['title'] : null;
        $done = isset($data['done']) ? $data['done'] : false;
        $todo->setTitle($title);
        $todo->setDone($done);
        try {
            $this->entitiManager->persist($todo);
            $this->entitiManager->flush();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return json_encode($todo);
    }

    public function editAction(int $id, array $data): string
    {
        $todo = $this->todoRepository->findById($id);
        $title = isset($data['title']) ? $data['title'] : $todo->getTitle();
        $done = isset($data['done']) ? $data['done'] : $todo->getDone();
        $todo->setTitle($title);
        $todo->setDone($done);
        try {
            $this->entitiManager->persist($todo);
            $this->entitiManager->flush();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return json_encode($todo);
    }

    public function removeAction(int $id): string
    {
        $todo = $this->todoRepository->findById($id);
        try {
            $this->entitiManager->remove($todo);
            $this->entitiManager->flush();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return json_encode($todo);
    }
}
