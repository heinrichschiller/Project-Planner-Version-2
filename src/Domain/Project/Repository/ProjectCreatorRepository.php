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

namespace App\Domain\Project\Repository;

use DateTime;
use Entities\Project;
use Psr\Container\ContainerInterface;

class ProjectCreatorRepository
{
    /**
     * @Injection
     * @var ContainerInterface
     */
    private $ci;

    /**
     * @Injection
     * @var Project 
     */
    private Project $project;

    /**
     * The constructor
     * 
     * @param ContainerInterface $ci
     * @param Project $project
     */
    public function __construct(ContainerInterface $ci, Project $project)
    {
        $this->ci = $ci;
        $this->project = $project;
    }

    /**
     * Create a project
     * 
     * @param array $data The form data
     */
    public function createProject(array $data)
    {
        $this->project->setTitle($data['title']);
        $this->project->setDescription($data['desc']);
        $this->project->setBeginAt($data['beginAt']);
        $this->project->setEndAt($data['endAt']);
        $this->project->setCreatedAt(new DateTime('now'));

        $contact = $this->ci->get('EntityManager')
            ->getRepository('Entities\Contact')
            ->find($data['contactId']);

        if ($contact === null) {
            echo "No contact found for the given id: {$data['id']}";
            exit(1);
        }

        $this->project->setContact($contact);

        $status = $this->ci->get('EntityManager')
            ->getRepository('Entities\Status')
            ->find($data['statusId']);

        if ($status === null) {
            echo "No status found for the given id: {$data['statusId']}";
            exit(1);
        }

        $this->project->setStatus($status);

        $priority = $this->ci->get('EntityManager')
            ->getRepository('Entities\Priority')
            ->find($data['priorityId']);

        if ($priority === null) {
            echo "No priority found for the given id: {$data['priorityId']}";
            exit(1);
        }
        
        $this->project->setPriority($priority);

        $this->ci->get('EntityManager')->persist($this->project);
        $this->ci->get('EntityManager')->flush();
    }
}