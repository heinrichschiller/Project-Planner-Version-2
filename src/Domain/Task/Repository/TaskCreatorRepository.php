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

use Entities\Task;
use DateTime;
use Doctrine\ORM\EntityManager;

class TaskCreatorRepository
{
    /**
     * @Injection
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * @Injection
     * @var Task
     */
    private Task $task;

    /**
     * The constructor
     * 
     * @param EntityManager $entityManager
     * @param Task $task
     */
    public function __construct(EntityManager $entityManager, Task $task)
    {
        $this->entityManager = $entityManager;
        $this->task = $task;
    }

    /**
     * Create a new task
     * 
     * @param array<mixed> $formData The form data
     * 
     * @return void
     */
    public function createTask(array $formData): void
    {
        $this->task->setTitle($formData['title']);
        $this->task->setDescription($formData['desc']);
        $this->task->setBeginAt($formData['beginAt']);
        $this->task->setEndAt($formData['endAt']);
        $this->task->setCreatedAt(new DateTime('now'));

        $contact = $this->entityManager
            ->getRepository('Entities\Contact')
            ->find($formData['contactId']);

        if (null === $contact) {
            echo "No contact found for the given id: {$formData['id']}";
            exit(1);
        }

        $this->task->setContact($contact);

        $project = $this->entityManager
            ->getRepository('Entities\Project')
            ->find($formData['projectId']);

        if (null === $project) {
            echo "No project found for the given id: {$formData['projectId']}";
            exit(1);
        }

        $this->task->setProject($project);

        $status = $this->entityManager
            ->getRepository('Entities\Status')
            ->find($formData['statusId']);

        if (null === $status) {
            echo "No status found for the given id: {$formData['statusId']}";
            exit(1);
        }
        
        $this->task->setStatus($status);

        $priority = $this->entityManager
            ->getRepository('Entities\Priority')
            ->find($formData['priorityId']);

        if (null === $priority) {
            echo "No priority found for the given id: {$formData['priorityId']}";
            exit(1);
        }

        $this->task->setPriority($priority);

        $this->entityManager->persist($this->task);
        $this->entityManager->flush();
    }
}