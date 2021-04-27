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

namespace App\Domain\Note\Repository;

use DateTime;
use Entities\Note;
use Doctrine\ORM\EntityManager;

class NoteCreatorRepository
{
    /**
     * @Injection
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * The constructor
     * 
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
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
        $note = new Note;

        $note->setTitle($formData['title']);
        $note->setDescription($formData['body']);

        if(!empty($formData['contactId'])) {
            $note->setContactId( (int) $formData['contactId']);
        }

        if(!empty($formData['projectId'])) {
            $note->setProjectId( (int) $formData['projectId']);
        }

        if(!empty($formData['taskId'])) {
            $note->setTaskId( (int) $formData['taskId']);
        }
        
        $note->setCreatedAt(new DateTime('now'));

        $this->entityManager->persist($note);
        $this->entityManager->flush();
    }
}