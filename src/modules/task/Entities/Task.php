<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2019 Heinrich Schiller
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

namespace App\Modules\Task\Entities;

class Task 
{
    /**
     * Id
     * 
     * @var integer
     */
    private int $_id = 0;
    
    /**
     * Title
     * 
     * @var string
     */
    private string $_title = '';
    
    /**
     * Description
     * 
     * @var string
     */
    private string $_desc = '';
    
    /**
     * Begin
     * 
     * @var string
     */
    private string $_beginAt = '';
    
    /**
     * End
     * 
     * @var string
     */
    private string $_endAt = '';
    
    /**
     * Creator Id
     * 
     * @var integer
     */
    private int $_creatorId = 0;

    /**
     * Creator
     * 
     * @var string
     */
    private string $_creator = '';
    
    /**
     * Priority Id
     * 
     * @var integer
     */
    private int $_priorityId = 0;

    /**
     * Priority
     * 
     * @var string
     */
    private $_priority;

    /**
     * Status Id
     * 
     * @var integer
     */
    private int $_statusId = 0;
    
    /**
     * Status
     * 
     * @var string
     */
    private string $_status = '';
    
    /**
     * Contact Id
     * 
     * @var integer
     */
    private int $_contactId = 0;
    
    /**
     * Contact
     * 
     * @var string
     */
    private string $_contact = '';

    /**
     * Project Id
     * 
     * @var integer
     */
    private int $_projectId = 0;
    
    /**
     * Project
     * 
     * @var string
     */
    private string $_project = '';

    /**
     * Employee id
     * 
     * @var int
     */
    private int $_employeeId = 0;

    /**
     * Employee
     * 
     * @var string
     */
    private $_employee = '';

    /**
     * Tested
     * 
     * @var int
     */
    private int $_testId = 0;

    /**
     * Deployment
     * 
     * @var boolean
     */
    private bool $_deployment = false;
    
    /**
     * Deployed at
     * 
     * @var string
     */
    private string $_deployedAt = '';

    /**
     * Created at
     * 
     * @var string
     */
    private string $_createdAt = '';
    
    /**
     * Updated At
     * 
     * @var string
     */
    private string $_updatedAt = '';

    /**
     * Get the value of _id
     * 
     * @return self
     */
    public function getId(): int
    {
        return (int) $this->_id;
    }

    /**
     * Set the value of _id
     * 
     * @param int $id - The id of a task.
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * Get the value of _title
     * 
     * @return self
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * Set the value of _title
     * 
     * @param string $title - The title of a task.
     */
    public function setTitle(string $title)
    {
        $this->_title = $title;
    }

    /**
     * Get the value of _desc
     * 
     * @return self
     */ 
    public function getDesc(): string
    {
        return $this->_desc;
    }

    /**
     * Set the value of _desc
     *
     * @param string $desc - The description of a task.
     */ 
    public function setDesc(string $desc)
    {
        $this->_desc = $desc;
    }

    /**
     * Get the value of _beginAt
     */
    public function getBeginAt(): string
    {
        return $this->_beginAt;
    }

    /**
     * Set the value of _beginAt
     * 
     * @param string $date - The begining of a task.
     */
    public function setBeginAt(string $date)
    {
        $this->_beginAt = $date;
    }

    /**
     * Get the value of _endAt
     */
    public function getEndAt()
    {
        return $this->_endAt;
    }

    /**
     * Set the value of _endAt
     * 
     * @param string $date - The begining of a task.
     */
    public function setEndAt(string $date)
    {
        $this->_endAt = $date;
    }

    /**
     * Get the value of _creatorId
     */
    public function getCreatorId(): int
    {
        return $this->_creatorId;
    }

    /**
     * Set the value of _creatorId
     * 
     * @param int $id - The id of a creator.
     */
    public function setCreatorId(int $id)
    {
        $this->_creatorId = $id;
    }

    /**
     * Get the value of _priorityId
     */
    public function getPriorityId(): int
    {
        return $this->_priorityId;
    }

    /**
     * Set the value of _priorityId
     * 
     * @param int $id - Set _priorityId of a task
     */
    public function setPriorityId(int $id)
    {
        $this->_priorityId = $id;
    }

    /**
     * Get the value of _priority
     * 
     * @return string 
     */
    public function getPriority(): string
    {
        return $this->_priority;
    }

    public function setPriority(string $priority)
    {
        $this->_priority = $priority;
    }

    public function getStatusId(): int
    {
        return $this->_statusId;
    }

    public function setStatusId(int $id)
    {
        $this->_statusId = $id;
    }

    public function getStatus(): string
    {
        return $this->_status;
    }

    public function setStatus(string $status)
    {
        $this->_status = $status;
    }

    public function getContactId(): int
    {
        return $this->_contactId;
    }

    public function setContactId(int $id)
    {
        $this->_contactId = $id;
    }

    public function getContact(): string
    {
        return $this->_contact;
    }

    public function setContact(string $contact)
    {
        $this->_contact = $contact;
    }

    public function getProjectId(): int
    {
        return $this->_projectId;
    }

    public function setProjectId(int $id)
    {
        $this->_projectId = $id;
    }

    public function getTestId(): int
    {
        return $this->_testId;
    }

    public function setTestId(int $id)
    {
        $this->_testId = $id;
    }

    public function getDeploymentAt(): string
    {
        return $this->_deployedAt;
    }

    public function setDeploymentAt(string $date)
    {
        $this->_deployedAt = $date;
    }

    public function getCreatedAt()
    {
        return $this->_createdAt;
    }

    public function setCreatedAt($date)
    {
        $this->_createdAt = $date;
    }

    public function getUpdatedAt()
    {
        return $this->_updatedAt;
    }

    public function setUpdatedAt($date)
    {
        $this->_updatedAt = $date;
    }

    public function getProject(): string
    {
        return $this->_project;
    }

    public function setProject(string $title)
    {
        $this->_project = $title;
    }
}