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

use App\Domain\Contact\Repository\ContactReaderRepository;
use App\Exception\ValidationException;

final class ContactReader
{
    /**
     * @Injection
     * @var ContactReaderRepository $repository
     */
    private ContactReaderRepository $repository;

    /**
     * The constructor
     * 
     * @param ContactReaderRepository $repository The repository
     */
    public function __construct(ContactReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Edit a contact
     * 
     * @param int $id Id of a contact
     * 
     * @return array
     */
    public function readContact(int $id): array
    {
        $this->validate($id);

        return $this->repository->readContact($id);
    }

    /**
     * Input validation
     * 
     * TODO: replace this old validation through CakePHP Validation
     * 
     * @param int $id Id of a contact
     * 
     * @return void
     */
    public function validate(int $id): void
    {
        $errors = [];

        if (empty($id)) {
            $errors['contactId'] = 'Input required';
        }
        
        if ($errors) {
            throw new ValidationException('Please check your inputs: ', $errors);
        }
    }
}