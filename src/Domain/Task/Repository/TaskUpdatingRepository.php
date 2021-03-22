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

namespace App\Domain\Task\Repository;

use DateTime;
use Doctrine\ORM\EntityManager;

class TaskUpdatingRepository
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
     * Update a task
     * 
     * @param array<mixed> $formData The form data
     * 
     * @return void
     */
    public function updateTask(array $formData): void
    {
        $task = $this->entityManager
            ->getRepository('Entities\Task')
            ->find( (int) $formData['id']);

        if ( null === $task ) {
            echo "No task found for the given id: {$formData['id']}";
            exit(1);
        }

        $task->setTitle($formData['title']);
        $task->setDescription($formData['desc']);
        $task->setBeginAt($formData['beginAt']);
        $task->setEndAt($formData['endAt']);
        $task->setStatusId( (int) $formData['statusId']);
        $task->setPriorityId( (int) $formData['priorityId']);
        $task->setUpdatedAt(new DateTime('now'));

        if( 5 === (int) $formData['statusId'] ) {
            $task->setFinishedOn(new DateTime('now'));
        }

        if( 6 === (int) $formData['statusId'] ) {
            $task->setDiscardedOn(new DateTime('now'));
        }

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}