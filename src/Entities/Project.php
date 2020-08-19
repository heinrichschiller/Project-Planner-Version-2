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

namespace Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Project
{
    /**
     * Id
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * 
     * @var int
     */
    protected int $id = 0;

    /**
     * Title
     * 
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    protected string $title = '';

    /**
     * Description
     * 
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    protected string $description = '';

    /**
     * Begin at
     * 
     * @ORM\Column(type="datetime", name="begin_at")
     * 
     * @var DateTime
     */
    protected DateTime $beginAt;

    /**
     * End at
     * 
     * @ORM\Column(type="datetime", name="end_at")
     * 
     * @var Datetime
     */
    protected DateTime $endAt;

    /**
     * Contact id
     * 
     * @ORM\Column(type="integer", name="contact_id")
     * 
     * @var int
     */
    protected int $contactId;
    
    /**
     * Status id
     * 
     * @ORM\Column(type="integer", name="status_id")
     * 
     * @var int
     */
    protected int $statusId = 0;

    /**
     * Priority Id
     * 
     * @ORM\Column(type="integer", name="priority_id")
     * 
     * @var int
     */
    protected int $priorityId = 0;

    /**
     * Created at
     * 
     * @ORM\Column(type="datetime", name="created_at")
     * 
     * @var DateTime
     */
    protected DateTime $createdAt;

    /**
     * Updated at
     * 
     * @ORM\Column(type="datetime", name="updated_at", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     * 
     * @var null|DataTime
     */
    protected ?DateTime $updatedAt;

    /**
     * Contact
     * 
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="assignedProjects")
     * 
     * @var Contact
     */
    protected Contact $contact;

    /**
     * Get id
     *
     * @return  int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return  string
     */ 
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param  string  $title  Title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get description
     *
     * @return  string
     */ 
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param  string  $description  Description
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get begin at
     *
     * @return  string
     */ 
    public function getBeginAt(): string
    {
        return $this->beginAt->format('d.m.Y H:i');
    }

    /**
     * Get the value of beginAt with DateTimeLocal-Format
     */
    public function getBeginAtDateTimeLocal(): string
    {
        return $this->beginAt->format('Y-m-d\TH:i');
    }

    /**
     * Set begin at
     *
     * @param  string  $date  Begin at
     */ 
    public function setBeginAt(string $date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $date);
        
        $this->beginAt = $dateTime;
    }

    /**
     * Get end at
     *
     * @return  string
     */ 
    public function getEndAt(): string
    {
        return $this->endAt->format('d.m.Y H:i');;
    }

    /**
     * Get the value of beginAt with DateTimeLocal-Format
     */
    public function getEndAtDateTimeLocal(): string
    {
        return $this->endAt->format('Y-m-d\TH:i');
    }

    /**
     * Set end at
     *
     * @param  string  $date  End at
     */ 
    public function setEndAt(string $date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $date);

        $this->endAt = $dateTime;
    }

    /**
     * Get status id
     *
     * @return  int
     */ 
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    /**
     * Get contact id
     *
     * @return  int
     */ 
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Set contact id
     *
     * @param  int  $contactId  Contact id
     */ 
    public function setContactId(int $contactId)
    {
        $this->contactId = $contactId;
    }
    
    /**
     * Set status id
     *
     * @param  int  $statusId  Status id
     */ 
    public function setStatusId(int $statusId)
    {
        $this->statusId = $statusId;
    }

    /**
     * Get priority Id
     *
     * @return  int
     */ 
    public function getPriorityId(): int
    {
        return $this->priorityId;
    }

    /**
     * Set priority Id
     *
     * @param  int  $priorityId  Priority Id
     */ 
    public function setPriorityId(int $priorityId)
    {
        $this->priorityId = $priorityId;
    }

    /**
     * Get created at
     *
     * @return  DateTime
     */ 
    public function getCreatedAt(): string
    {
        return $this->createdAt->format("d:m:Y H:i");
    }

    /**
     * Set created at
     *
     * @param  DateTime  $createdAt  Created at
     */ 
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get updated at
     *
     * @return  DataTime
     */ 
    public function getUpdatedAt(): string 
    {
        $str = '';

        if ( $this->updatedAt !== null ) {
            $str = $this->updatedAt->format('d.m.Y H:i');
        }
        
        return $str;
    }

    /**
     * Set updated at
     *
     * @param  null|DataTime  $updatedAt  Updated at
     */ 
    public function setUpdatedAt(?DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get contact
     *
     * @return  Contact
     */ 
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * Set contact
     *
     * @param  Contact  $contact  Contact
     */ 
    public function setContact(Contact $contact)
    {
        $contact->assignedToProject($this);

        $this->contact = $contact;
    }

}