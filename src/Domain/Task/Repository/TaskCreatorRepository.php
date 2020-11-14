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

namespace App\Domain\Task\Repository;

use Entities\Task;
use DateTime;
use Psr\Container\ContainerInterface;

class TaskCreatorRepository
{
    private $ci;
    private Task $task;

    public function __construct(ContainerInterface $ci, Task $task)
    {
        $this->ci = $ci;
        $this->task = $task;
    }

    public function createTask(array $formData)
    {
        $this->task->setTitle($formData['title']);
        $this->task->setDescription($formData['desc']);
        $this->task->setBeginAt($formData['beginAt']);
        $this->task->setEndAt($formData['endAt']);
        $this->task->setCreatedAt(new DateTime('now'));

        $contact = $this->ci->get('EntityManager')
            ->getRepository('Entities\Contact')
            ->find($formData['contactId']);

        if (null === $contact) {
            echo "No contact found for the given id: {$formData['id']}";
            exit(1);
        }

        $this->task->setContact($contact);

        $project = $this->ci->get('EntityManager')
            ->getRepository('Entities\Project')
            ->find($formData['projectId']);

        if (null === $project) {
            echo "No project found for the given id: {$formData['projectId']}";
            exit(1);
        }

        $this->task->setProject($project);

        $status = $this->ci->get('EntityManager')
            ->getRepository('Entities\Status')
            ->find($formData['statusId']);

        if (null === $status) {
            echo "No status found for the given id: {$formData['statusId']}";
            exit(1);
        }
        
        $this->task->setStatus($status);

        $priority = $this->ci->get('EntityManager')
            ->getRepository('Entities\Priority')
            ->find($formData['priorityId']);

        if ($priority === null) {
            echo "No priority found for the given id: {$formData['priorityId']}";
            exit(1);
        }

        $this->task->setPriority($priority);

        $this->ci->get('EntityManager')->persist($this->task);
        $this->ci->get('EntityManager')->flush();
    }
}