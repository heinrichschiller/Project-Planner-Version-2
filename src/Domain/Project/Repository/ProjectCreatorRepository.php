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

use DateTime;
use Doctrine\ORM\EntityManager;
use Entities\Project;

class ProjectCreatorRepository
{
    /**
     * @Injection
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * @Injection
     * @var Project 
     */
    private Project $project;

    /**
     * The constructor
     * 
     * @param EntityManager $entityManager
     * @param Project $project
     */
    public function __construct(EntityManager $entityManager, Project $project)
    {
        $this->entityManager = $entityManager;
        $this->project = $project;
    }

    /**
     * Create a project
     * 
     * @param array<mixed> $formData The form data
     * 
     * @return int Last insert id
     */
    public function createProject(array $formData): int
    {
        $this->project->setTitle($formData['title']);
        $this->project->setDescription($formData['desc']);
        $this->project->setBeginAt($formData['beginAt']);
        $this->project->setEndAt($formData['endAt']);
        $this->project->setCreatedAt(new DateTime('now'));

        $contact = $this->entityManager
            ->getRepository('Entities\Contact')
            ->find($formData['contactId']);

        if ($contact === null) {
            echo "No contact found for the given id: {$formData['id']}";
            exit(1);
        }

        $this->project->setContact($contact);

        $status = $this->entityManager
            ->getRepository('Entities\Status')
            ->find($formData['statusId']);

        if ($status === null) {
            echo "No status found for the given id: {$formData['statusId']}";
            exit(1);
        }

        $this->project->setStatus($status);

        $priority = $this->entityManager
            ->getRepository('Entities\Priority')
            ->find($formData['priorityId']);

        if ($priority === null) {
            echo "No priority found for the given id: {$formData['priorityId']}";
            exit(1);
        }
        
        $this->project->setPriority($priority);

        $this->entityManager->persist($this->project);
        $this->entityManager->flush();

        return $this->project->getId();
    }
}