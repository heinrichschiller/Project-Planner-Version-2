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

namespace App\Domain\Task\Service;

use App\Domain\Task\Repository\TaskCreatorRepository;
use App\Exception\ValidationException;
use Cake\Validation\Validator;

final class TaskCreator
{
    private TaskCreatorRepository $repository;

    public function __construct(TaskCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createTask(array $formData)
    {
        $this->validateNewTask($formData);

        $this->repository->createTask($formData);
    }

    public function validateNewTask(array $formData)
    {
        $validator = new Validator;

        $validator
            ->requirePresence('title', 'This field is required')
            ->notEmptyString('title', 'Title is required');

        $errors = $validator->validate($formData);

        if($errors) {
            throw new ValidationException('Please check your input: ', $errors);
        }
    }
}