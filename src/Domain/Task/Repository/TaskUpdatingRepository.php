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

use DateTime;
use Psr\Container\ContainerInterface;

class TaskUpdatingRepository
{
    private $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function updateTask(array $data)
    {
        $task = $this->ci->get('EntityManager')
            ->getRepository('Entities\Task')
            ->find($data['id']);

        if ( $task === null ) {
            echo "No task found for the given id: {$data['id']}";
            exit(1);
        }

        $task->setTitle($data['title']);
        $task->setDescription($data['desc']);
        $task->setBeginAt($data['beginAt']);
        $task->setEndAt($data['endAt']);
        $task->setStatusId($data['statusId']);
        $task->setPriorityId($data['priorityId']);
        $task->setUpdatedAt(new DateTime('now'));

        if( 5 === (int) $data['statusId'] ) {
            $task->setFinishedOn(new DateTime('now'));
        }

        if( 6 === (int) $data['statusId'] ) {
            $task->setDiscardedOn(new DateTime('now'));
        }

        $this->ci->get('EntityManager')->persist($task);
        $this->ci->get('EntityManager')->flush();
    }
}