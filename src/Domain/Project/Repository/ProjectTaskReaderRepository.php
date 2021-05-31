<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2019-2020 Heinrich Schiller
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

declare(strict_types = 1);

namespace App\Domain\Project\Repository;

use Doctrine\ORM\EntityManager;

class ProjectTaskReaderRepository
{
    /**
     * @Injection
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * The constructor
     * 
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Read a project task by id
     * 
     * @param int $id Id of a project task
     * 
     * @return array<mixed>
     */
    public function findOpenTasks(int $id): array
    {
        return (array) $this->entityManager
            ->createQueryBuilder()
            ->select('t')
            ->from('Entities\Task', 't')
            ->where('t.projectId = :id')
            ->andWhere('t.statusId != 5 AND t.statusId != 6')
            ->orderBy('t.priorityId', 'ASC')
            ->setParameter(':id', $id)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find all open tasks
     * 
     * @param int $id Id of a project task
     * 
     * @return array<mixed>
     */
    public function findAllOpenTasks(int $id): array
    {
        return (array) $this->entityManager
            ->createQueryBuilder()
            ->select('t')
            ->from('Entities\Task', 't')
            ->where('t.projectId = :id')
            ->andWhere('t.statusId != 5 AND t.statusId != 6')
            ->orderBy('t.priorityId', 'ASC')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find all open tasks
     * 
     * @param int $id Id of a project task
     * 
     * @return array<mixed>
     */
    public function findAllClosedTasks(int $id): array
    {
        return (array) $this->entityManager
            ->createQueryBuilder()
            ->select('t')
            ->from('Entities\Task', 't')
            ->where('t.projectId = :id')
            ->andWhere('t.statusId = 5 OR t.statusId = 6')
            ->orderBy('t.priorityId', 'ASC')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult();
    }
}