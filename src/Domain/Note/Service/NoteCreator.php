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

use App\Domain\Note\Repository\NoteCreatorRepository;
use App\Exception\ValidationException;
use Cake\Validation\Validator;

final class NoteCreator
{
    /**
     * @Injection
     * @var NoteCreatorRepository
     */
    private NoteCreatorRepository $repository;

    /**
     * @Injection
     * @var Validator
     */
    private Validator $validator;

    /**
     * The constructor
     * 
     * @param NoteCreatorRepository $repository
     * @param Validator $validator
     */
    public function __construct(NoteCreatorRepository $repository, Validator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Insert note
     * 
     * @param array<mixed> $formData The form data
     * 
     * @return void
     */
    public function insertNote(array $formData): void
    {
        $this->validate($formData);

        $this->repository->insertNote($formData);
    }

    /**
     * Validation
     * 
     * @param array<mixed> $formData The form data
     * 
     * @throws ValidationException
     * 
     * @return void
     */
    public function validate(array $formData): void
    {
        $this->validator
            ->allowEmptyString('title', 'Title cannot be empty', true)
            ->requirePresence('body')
            ->notEmptyString('body')
            ->add('desc', [
                'length' => [
                    'rule' => ['minLength', 10],
                    'message' => 'Description need to be at least 10 characters long'
                ]
            ]);

        $errors = $this->validator->validate($formData);

        if($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}