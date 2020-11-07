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

namespace App\Domain\Project\Service;

use App\Domain\Project\Repository\ProjectCreatorRepository;
use App\Exception\ValidationException;

final class ProjectCreator
{
    /**
     * @Injection
     * @var ProjectCreatorRepository
     */
    private ProjectCreatorRepository $repository;

    /**
     * The construct
     * 
     * @param ProjectCreatorRepository $repository
     */
    public function __construct(ProjectCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Insert new project
     * 
     * @param array $data
     */
    public function createProject(array $data)
    {
        $this->validateNewProject($data);

        $this->repository->createProject($data);
    }

    /**
     * Input validation
     * 
     * @param array $data
     *
     * @throws ValidationException
     * 
     * @return void
     */
    public function validateNewProject(array $data)
    {
        $errors = [];

        if( empty($data['title']) ) {
            $errors['title'] = 'Input required.';
        }

        if( empty($data['desc']) ) {
            $errors['description'] = 'Input required.';
        }

        if( empty($data['beginAt']) ) {
            $errors['beginAt'] = 'Input required.';
        }

        if( empty($data['endAt']) ) {
            $errors['endAt'] = 'Input required.';
        }

        if( empty($data['statusId']) ) {
            $errors['statusId'] = 'Status id is empty.';
        } elseif ( false === filter_var($data['statusId'], FILTER_VALIDATE_INT) ) {
            $errors['statusId'] = 'Id is not a number.';
        }

        if( empty($data['priorityId']) ) {
            $errors = 'Priority id is empty.';
        } elseif ( false === filter_var($data['priorityId'], FILTER_VALIDATE_INT) ) {
            $errors['priorityId'] = 'Id is not a number.';
        }

        if( empty($data['contactId']) ) {
            $errors = 'Contact id is empty';
        } elseif ( false === filter_var($data['contactId'], FILTER_VALIDATE_INT) ) {
            $errors['contactId'] = 'Id is not a number.';
        }

        if ( $errors ) {
            throw new ValidationException('Please check your inputs: ', $errors);
        }

    }
}