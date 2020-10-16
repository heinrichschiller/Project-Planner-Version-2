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

namespace App\Application\Actions\Task;

use App\Application\Actions\Action;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Entities\Task;
use DateTime;

class CreateAction extends Action
{
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $task = new Task;

        $data = (array) $request->getParsedBody();

        $task->setTitle($data['title']);
        $task->setDescription($data['desc']);
        $task->setBeginAt($data['beginAt']);
        $task->setEndAt($data['endAt']);
        $task->setCreatedAt(new DateTime('now'));

        $contact = $this->entityManager()
            ->getRepository('Entities\Contact')
            ->find($data['contactId']);

        if ($contact === null) {
            echo "No contact found for the given id: {$data['id']}";
            exit(1);
        }

        $task->setContact($contact);

        $project = $this->entityManager()
            ->getRepository('Entities\Project')
            ->find($data['projectId']);

        if ($project === null) {
            echo "No project found for the given id: {$data['projectId']}";
            exit(1);
        }

        $task->setProject($project);

        $status = $this->entityManager()
            ->getRepository('Entities\Status')
            ->find($data['statusId']);

        if ($status === null) {
            echo "No status found for the given id: {$data['statusId']}";
            exit(1);
        }
        
        $task->setStatus($status);

        $priority = $this->entityManager()
            ->getRepository('Entities\Priority')
            ->find($data['priorityId']);

        if ($priority === null) {
            echo "No priority found for the given id: {$data['priorityId']}";
            exit(1);
        }

        $task->setPriority($priority);

        $this->entityManager()->persist($task);
        $this->entityManager()->flush();

        return $response;
    }
}