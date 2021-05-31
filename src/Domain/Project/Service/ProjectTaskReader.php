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

namespace App\Domain\Project\Service;

use App\Domain\Project\Repository\ProjectTaskReaderRepository;

final class ProjectTaskReader
{
    /**
     * @Injection
     * @var ProjectTaskReaderRepository
     */
    private ProjectTaskReaderRepository $repository;

    /**
     * The constructor
     * 
     * @param ProjectTaskReaderRepository $repository
     */
    public function __construct(ProjectTaskReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a project task
     * 
     * @param int $id Id of a project
     * 
     * @return array<mixed>
     */
    public function findOpenTasks(int $id): array
    {
        return $this->repository->findOpenTasks($id);
    }

    /**
     * Find all open tasks
     * 
     * @param int $id Id of a project
     * 
     * @return array<mixed>
     */
    public function findAllOpenTasks(int $id): array
    {
        return $this->repository->findAllOpenTasks($id);
    }

    /**
     * Find all closed tasks
     * 
     * @param int $id Id of a project
     * 
     * @return array<mixed>
     */
    public function findAllClosedTasks(int $id): array
    {
        return $this->repository->findAllClosedTasks($id);
    }
}