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

namespace App\Domain\Contact\Repository;

use Psr\Container\ContainerInterface;
use DateTime;
use Doctrine\ORM\EntityManager;

class ContactUpdatingRepository
{
    /**
     * @Injection
     * @var ContainerInterface
     */
    private $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    /**
     * Doctrine entity manager
     * 
     * @return EntityManager
     */
    private function entityManager(): EntityManager
    {
        return $this->ci->get('EntityManager');
    }

    /**
     * Update a contact
     * 
     * @param array $data The form data.
     */
    public function updateContact(array $data)
    {
        $contact = $this->entityManager()
            ->getRepository('Entities\Contact')
            ->find($data['id']);
        
        if ( $contact === null ) {
            echo "No contact found for the given id: {$data['id']}";
            exit(1);
        }

        $contact->setDisplayName($data['name']);
        $contact->setUpdatedAt(new DateTime('now'));
        
        $this->entityManager()->persist($contact);
        $this->entityManager()->flush();
    }
}