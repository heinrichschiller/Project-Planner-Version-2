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

namespace App\Domain\Contact\Service;

use App\Domain\Contact\Repository\ContactUpdatingRepository;
use App\Exception\ValidationException;

final class ContactUpdating
{
    /**
     * @Injection
     * @var ContactUpdatingRepository 
     */
    private ContactUpdatingRepository $repository;

    /**
     * The constructor
     * 
     * @param ContactUpdatingRepository $repository
     */
    public function __construct(ContactUpdatingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Contact update
     * 
     * @param array $data The form data
     * @param int $id Id of a contact
     */
    public function contactUpdate(array $data)
    {
        $this->validateContactUpdating($data);

        $this->repository->updateContact($data);
    }

    /**
     * Input validation
     * 
     * @param array $data The form data
     * @param int $id Id of a contact
     */
    public function validateContactUpdating(array $data)
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['contactName'] = 'Input required.';
        }

        if (empty($data['id'])) {
            $errors['contactId'] = 'Id required.';
        }

        if ($errors) {
            throw new ValidationException('Please check your inputs: ', $errors);
        }
    }
}