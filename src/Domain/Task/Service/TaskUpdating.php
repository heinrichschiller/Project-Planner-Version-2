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

use App\Domain\Task\Repository\TaskUpdatingRepository;
use App\Exception\ValidationException;
use Cake\Validation\Validator;

final class TaskUpdating
{
    /**
     * @Injection
     * @var TaskUpdatingRepository
     */
    private TaskUpdatingRepository $repository;

    /**
     * @Injection
     * @var Validator
     */
    private Validator $validator;

    /**
     * The constructor
     * 
     * @param TaskUpdatingRepository $repository
     * @param Validator $validator
     */
    public function __construct(TaskUpdatingRepository $repository, Validator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Task update
     * 
     * @param array $formData The form data
     */
    public function updateTask(array $formData)
    {
        $this->validateTaskUpdate($formData);

        $this->repository->updateTask($formData);
    }

    /**
     * Input validation
     * 
     * @param array $formData The form data
     * 
     * @throws ValidationException
     */
    public function validateTaskUpdate(array $formData)
    {
        $this->validator
            ->requirePresence('title', 'This field is required')
            ->notEmptyString('title', 'Title is required');
        
        $errors = $this->validator->validate($formData);

        if ($errors) {
            throw new ValidationException('Please check your input: ', $errors);
        }
    }
}