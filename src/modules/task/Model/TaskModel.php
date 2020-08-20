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

namespace App\Modules\Task\Model;

use App\Library\Model;
use App\Interfaces\ModelInterface;
use DateTime;
use Doctrine\ORM\EntityManager;
use Entities\Task;

class TaskModel extends Model implements ModelInterface 
{
    private ?EntityManager $entityManager = null;

    public function __construct()
    {
        $this->entityManager = $this->entityManager();
    }

    public function create($data) {

        $task = new Task;

        $task->setTitle($data['title']);
        $task->setDescription($data['desc']);
        $task->setBeginAt($data['beginAt']);
        $task->setEndAt($data['endAt']);
        $task->setStatusId($data['statusId']);
        $task->setPriorityId($data['priorityId']);
        $task->setCreatedAt(new DateTime('now'));

        $contactRepository = $this->entityManager->getRepository('Entities\Contact');
        $contact = $contactRepository->find($data['contactId']);

        if ($contact === null) {
            echo "No contact found for the given id: {$data['id']}";
            exit(1);
        }

        $task->setContact($contact);

        $projectRepository = $this->entityManager->getRepository('Entities\Project');
        $project = $projectRepository->find($data['projectId']);

        if ($contact === null) {
            echo "No project found for the given id: {$data['id']}";
            exit(1);
        }

        $task->setProject($project);

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function read(int $id) 
    {
        $query = $this->entityManager->createQueryBuilder()
            ->select('t, c, p')
            ->from('Entities\Task', 't')
            ->leftJoin('t.contact', 'c')
            ->leftJoin('t.project', 'p')
            ->where('t.id = :id')
            ->setParameter(':id', $id)
            ->getQuery();
        
        return $query->getSingleResult();
    }

    public function update($data)
    {
        $taskRepository = $this->entityManager->getRepository('Entities\Task');
        $task = $taskRepository->find($data['id']);

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

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function delete() {}

    public function findAllTasks()
    {
        $query = $this->entityManager->createQueryBuilder()
            ->select('t, c, p')
            ->from('Entities\Task', 't')
            ->leftJoin('t.contact', 'c')
            ->leftJoin('t.project', 'p')
            ->getQuery();

        return $query->getResult();
    }

    public function getPriorityList()
    {
        $priorityRepository = $this->entityManager->getRepository('Entities\Priority');

        return $priorityRepository->findAll();
    }

    public function getStatusList()
    {
        $statusRepository = $this->entityManager->getRepository(('Entities\Status'));

        return $statusRepository->findAll();
    }

    public function getContactList()
    {
        $contactRepository = $this->entityManager->getRepository(('Entities\Contact'));

        return $contactRepository->findAll();
    }

    public function getProjectList()
    {
        $projectRepository = $this->entityManager->getRepository(('Entities\Project'));
        
        return $projectRepository->findAll();
    }
}