<?php
declare(strict_types=1);

namespace Todo\Model;

use Todo\Model\Entity\Todo;

interface TodoRepositoryInterface
{

    /**
     * @return Todo[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return object|Todo
     */
    public function findById(int $id): Todo;
}