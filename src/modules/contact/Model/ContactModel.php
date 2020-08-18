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

declare( strict_types = 1 );

namespace App\Modules\Contact\Model;

use App\Interfaces\ModelInterface;
use App\Library\Model;
use DateTime;
use Doctrine\ORM\EntityManager;
use Entities\Contact;

class ContactModel extends Model implements ModelInterface
{
    protected ?EntityManager $entityMananger = null;

    public function __construct()
    {
        $this->entityManager = $this->entityManager();
    }

    /**
     * Create a new contact.
     */
    public function create($data) {
        $newContact = new Contact;

        $newContact->setDisplayName($data['name']);
        $newContact->setCreatedAt(new DateTime('now'));

        $this->entityManager->persist($newContact);
        $this->entityManager->flush();
    }

    /**
     * Read a contact by id.
     * 
     * @param int $id
     * 
     * @return []
     */
    public function read($id) {
        $contactRepository = $this->entityManager->getRepository('Entities\Contact');

        return $contactRepository->find($id);
    }

    public function update($data) {}

    public function delete() {}

    /**
     * Get all contacts
     * 
     * @return []
     */
    public function findAllContacts()
    {
        $contactRepository = $this->entityManager->getRepository('Entities\Contact');

        return $contactRepository->findAll();
    }
}