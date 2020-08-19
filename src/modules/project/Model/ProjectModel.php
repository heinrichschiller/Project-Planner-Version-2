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

namespace App\Modules\Project\Model;

use App\Interfaces\ModelInterface;
use App\Library\Model;
use DateTime;
use Doctrine\ORM\EntityManager;

class ProjectModel extends Model implements ModelInterface
{
    protected ?EntityManager $entityMananger = null;

    public function __construct()
    {
        $this->entityManager = $this->entityManager();
    }

    public function create(array $data) {}

    public function read(int $id) {}

    public function update(array $data) {}

    public function delete() {}

    /**
     * Get all projects
     * 
     * @return []
     */
    public function findAllProjects()
    {
        $projectRepository = $this->entityManager->getRepository('Entities\Project');

        return $projectRepository->findAll();
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
}