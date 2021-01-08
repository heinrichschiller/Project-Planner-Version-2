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

namespace Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
class Task
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
     * @ORM\Column(type="string", length=2000)
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
     * @var DateTime
     */
    protected DateTime $endAt;

    /**
     * Status id
     * 
     * @ORM\Column(type="integer", name="status_id")
     * 
     * @var int
     */
    protected int $statusId = 0;

    /**
     * Priority id
     * 
     * @ORM\Column(type="integer", name="priority_id")
     * 
     * @var int
     */
    protected int $priorityId = 0;

    /**
     * Contact id
     * 
     * @ORM\Column(type="integer", name="contact_id", nullable=true)
     * 
     * @var int
     */
    protected int $contactId = 0;

    /**
     * Project id
     * 
     * @ORM\Column(type="integer", name="project_id", nullable=true)
     * 
     * @var int
     */
    protected int $projectId = 0;

    /**
     * Created at
     * 
     * @ORM\Column(type="datetime", name="created_at")
     * 
     * @var null|DateTime
     */
    protected ?DateTime $createdAt = null;

    /**
     * Updated at
     * 
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     * 
     * @var null|DateTime
     */
    protected ?DateTime $updatedAt;

    /**
     * Finished on
     * 
     * @ORM\Column(type="datetime", name="finished_on", nullable=true)
     * 
     * @var null|DateTime
     */
    protected ?DateTime $finishedOn;

    /**
     * Discarded on
     * 
     * @ORM\Column(type="datetime", name="discarded_on", nullable=true)
     */
    protected ?DateTime $discardedOn;

    /**
     * Contact
     * 
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="assignedTasks")
     * 
     * @var Contact
     */
    protected Contact $contact;

    /**
     * Project
     * 
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="assignedTasks")
     * 
     * @var Project
     */
    protected Project $project;

    /**
     * Status
     * 
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="tasks")
     * 
     * @var Status
     */
    protected Status $status;

    /**
     * Priority
     * 
     * @ORM\ManyToOne(targetEntity="Priority", inversedBy="tasks")
     * 
     * @var Priority
     */
    protected Priority $priority;

    /*
    |----------------------------------------------------------------------------
    | Getter && Setter
    |----------------------------------------------------------------------------
    */

    /**
     * Get id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param  string  $title  Title
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
    public function getDescription()
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
        return $this->beginAt->format($_ENV['DATETIME_FORMAT']);
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
        return $this->endAt->format($_ENV['DATETIME_FORMAT']);
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
     * Set status id
     *
     * @param  int  $statusId  Status id
     */ 
    public function setStatusId(int $statusId)
    {
        $this->statusId = $statusId;
    }

    /**
     * Get priority id
     *
     * @return  int
     */ 
    public function getPriorityId(): int
    {
        return $this->priorityId;
    }

    /**
     * Set priority id
     *
     * @param  int  $priorityId  Priority id
     */ 
    public function setPriorityId(int $priorityId)
    {
        $this->priorityId = $priorityId;
    }

    /**
     * Get contact id
     *
     * @return  int
     */ 
    public function getContactId(): int
    {
        return $this->contactId;
    }
    
    /**
     * Get project id
     *
     * @return  int
     */ 
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * Get created at
     *
     * @return string
     */ 
    public function getCreatedAt(): string
    {
        return $this->createdAt->format($_ENV['DATETIME_FORMAT']);
    }

    /**
     * Set created at
     *
     * @param  null|DateTime  $createdAt  Created at
     */ 
    public function setCreatedAt(?DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get updated at
     *
     * @return string
     */ 
    public function getUpdatedAt(): string 
    {
        $str = '';

        if ( $this->updatedAt !== null ) {
            $str = $this->updatedAt->format($_ENV['DATETIME_FORMAT']);
        }
        
        return $str;
    }

    /**
     * Set updated at
     *
     * @param  null|DateTime  $updatedAt  Updated at
     */ 
    public function setUpdatedAt(?DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

        /**
     * Get finished on
     * 
     * @return string
     */
    public function getFinishedOn(): string
    {
        $str = '';

        if ( null !== $this->finishedOn ) {
            $str = $this->finishedOn->format('d.m.Y H:i');
        }
        
        return $str;
    }

    /**
     * Set finished on
     * 
     * @param null|DateTime $finishedOn 
     */
    public function setFinishedOn(?DateTime $finishedOn)
    {
        $this->finishedOn = $finishedOn;
    }

    /**
     * Get discarded on
     * 
     * @return string
     */
    public function getDiscardedOn(): string
    {
        $str = '';

        if ( null !== $this->discardedOn ) {
            $str = $this->discardedOn->format('d.m.Y H:i');
        }
        
        return $str;
    }

    /**
     * Set discarded on
     * 
     * @param null|DateTime $discardedOn 
     */
    public function setDiscardedOn(?DateTime $discardedOn)
    {
        $this->discardedOn = $discardedOn;
    }

    /**
     * Get contact
     *
     * @return  Contact
     */ 
    public function getContact()
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
        $contact->assignedToTask($this);
        
        $this->contact = $contact;
    }

    /**
     * Get project
     *
     * @return  Project
     */ 
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set project
     *
     * @param Project $project Project
     */ 
    public function setProject(Project $project)
    {
        $project->assignedToTask($this);
        
        $this->project = $project;
    }

    /**
     * Get status
     *
     * @return  Status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  Status  $status  Status
     */ 
    public function setStatus(Status $status)
    {
        $this->status = $status;
    }

    /**
     * Get priority
     *
     * @return  Priority
     */ 
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set priority
     *
     * @param  Priority  $priority  Priority
     */ 
    public function setPriority(Priority $priority)
    {
        $this->priority = $priority;
    }
}