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

namespace App\Domain\Contact\Repository;

use DateTime;
use Doctrine\ORM\EntityManager;

class ContactUpdatingRepository
{
    /**
     * @Injection
     * @var EntityManager
     */
    private $entityManager;

    /**
     * The constructor
     * 
     * @param EntityManager $entityManager Entity Manager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Update a contact
     * 
     * @param array $formData The form data.
     * 
     * @return int
     */
    public function updateContact(array $formData): int
    {
        $contact = $this->entityManager
            ->getRepository('Entities\Contact')
            ->find( (int) $formData['id']);
        
        if ( $contact === null ) {
            echo "No contact found for the given id: {$formData['id']}";
            exit(1);
        }

        $contact->setDisplayName($formData['display_name']);
        $contact->setUpdatedAt(new DateTime('now'));
    
        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        return $contact->getId();
    }
}