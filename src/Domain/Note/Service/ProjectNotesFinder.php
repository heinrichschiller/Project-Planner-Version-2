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

namespace App\Domain\Note\Service;

use App\Domain\Note\Repository\ProjectNoteFinderRepository;

final class ProjectNotesFinder
{
    /**
     * @Injection
     * @var ProjectNoteFinderRepository
     */
    private ProjectNoteFinderRepository $repository;

    /**
     * The constructor
     * 
     * @param ProjectNoteFinderRepository $repository
     */
    public function __construct(ProjectNoteFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find all notes by id
     * 
     * @param int $id Contact or project or task id
     * 
     * @return array<mixed> Notes from id.
     */
    public function findAll(int $id): array
    {
        return $this->repository->findAll($id);
    }
}