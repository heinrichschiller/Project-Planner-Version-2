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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="notes")
 */
class Note
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
    private int $id = 0;

    /**
     * Title
     * 
     * @ORM\Column(type="string", nullable=true)
     * 
     * @var string
     */
    private string $title = '';

    /**
     * Description
     * 
     * @ORM\Column(type="string", length=2000)
     * 
     * @var string
     */
    private string $description = '';

    /**
     * Contact id
     * 
     * @ORM\Column(type="integer", name="contact_id", nullable=true)
     * 
     * @var int
     */
    private int $contactId = 0;

    /**
     * Project id
     * 
     * @ORM\Column(type="integer", name="project_id", nullable=true)
     * 
     * @var int
     */
    private int $projectId = 0;

    /**
     * Task id
     * 
     * @ORM\Column(type="integer", name="task_id", nullable=true)
     * 
     * @var int
     */
    private int $taskId = 0;

    /**
     * Created at
     * 
     * @ORM\Column(type="datetime", name="created_at")
     * 
     * @var DateTime
     */
    private DateTime $createdAt;

    /**
     * Updated at
     * 
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     * 
     * @var null|DateTime
     */
    private ?DateTime $updatedAt;

    /*
    |----------------------------------------------------------------------------
    | Getter && Setter
    |----------------------------------------------------------------------------
    */

    /**
     * Get the value of id
     * 
     * @return int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of title
     * 
     * @return string
     */ 
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     * 
     * @param string $title Title of a notice
     * 
     * @return void
     */ 
    public function setTitle(string $title): void
    {
        $title = trim($title, " \n\r\t\v\0");

        $this->title = $title;
    }

    /**
     * Get the value of desc
     * 
     * @return string
     */ 
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of desc
     *
     * @param string $desc Description of a notice
     * 
     * @return void
     */ 
    public function setDescription(string $desc): void
    {
        $this->description = $desc;
    }

    /**
     * Get the value of contactId
     * 
     * @return int
     */ 
    public function getContactId(): int
    {
        return $this->contactId;
    }

    /**
     * Set the value of contactId
     *
     * @param int $contactId
     * 
     * @return void
     */ 
    public function setContactId(int $contactId): void
    {
        $this->contactId = $contactId;
    }

    /**
     * Get the value of projectId
     * 
     * @return int
     */ 
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * Set the value of projectId
     *
     * @param int $projectId
     * 
     * @return void
     */ 
    public function setProjectId(int $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * Get the value of taskId
     * 
     * @return int
     */ 
    public function getTaskId(): int
    {
        return $this->taskId;
    }

    /**
     * Set the value of taskId
     *
     * @param int $taskId 
     * 
     * @return void
     */ 
    public function setTaskId(int $taskId): void
    {
        $this->taskId = $taskId;
    }

    /**
     * Get the value of createdAt
     * 
     * @return DateTime
     */ 
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param DateTime $createdAt
     * 
     * @return void
     */ 
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get the value of updatedAt
     * 
     * @return DateTime
     */ 
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return void
     */ 
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}