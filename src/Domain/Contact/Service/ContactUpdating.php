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

namespace App\Domain\Contact\Service;

use App\Domain\Contact\Repository\ContactUpdatingRepository;
use App\Exception\ValidationException;
use Cake\Validation\Validator;

final class ContactUpdating
{
    /**
     * @Injection
     * @var ContactUpdatingRepository 
     */
    private ContactUpdatingRepository $repository;

    /**
     * @Injection
     * @var Validator
     */
    private Validator $validator;

    /**
     * The constructor
     * 
     * @param ContactUpdatingRepository $repository
     */
    public function __construct(ContactUpdatingRepository $repository, Validator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Contact update
     * 
     * @param array<mixed> $formData The form data
     * 
     * @return int
     */
    public function contactUpdate(array $formData): int
    {
        $this->validate($formData);

        return (int) $this->repository->updateContact($formData);
    }

    /**
     * Input validation
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
            ->requirePresence('display_name')
            ->notEmptyString('display_name')
            ->add('display_name', [
                'length' => [
                    'rule' => ['minLength', 3],
                    'message' => 'Display name need to be at least 3 characters long'
                ]
            ])
            ->requirePresence([
                'id' => [
                    'mode' => 'update',
                    'message' => 'An id is required'
                ]
            ]);

        $errors = $this->validator->validate($formData);
        
        if ($errors) {
            throw new ValidationException('Please check your inputs: ', $errors);
        }
    }
}