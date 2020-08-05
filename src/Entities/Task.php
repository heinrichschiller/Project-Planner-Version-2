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
 * @ORM\Table(name="tasks")
 */
class Task 
{
    use \Traits\IdentifiableTrait;
    use \Traits\PropertiesableTrait;
    use \Traits\TimestampableTrait;

    /**
     * Contact Id
     * 
     * @ORM\Column(type="integer", name="contact_id", nullable=true)
     * 
     * @var integer
     */
    protected int $contactId = 0;

    /**
     * Project Id
     * 
     * @ORM\Column(type="integer", name="project_id", nullable=true)
     * 
     * @var integer
     */
    protected int $projectId = 0;

    /**
     * Tested
     * 
     * @ORM\Column(type="integer", name="test_id")
     * 
     * @var int
     */
    protected int $testId = 0;

    /**
     * Deployed
     * 
     * @ORM\Column(type="boolean", options={"defaul": false})
     * 
     * @var boolean
     */
    protected bool $deployed = false;
    
    /**
     * Deployed at
     * 
     * @ORM\Column(type="datetime", name="deployed_at")
     * @var DateTime
     */
    protected DateTime $deployedAt;

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getContactId(): int
    {
        return $this->contactId;
    }

    public function setContactId(int $id)
    {
        $this->contactId = $id;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function setProjectId(int $id)
    {
        $this->projectId = $id;
    }

    public function getTestId(): int
    {
        return $this->testId;
    }

    public function setTestId(int $id)
    {
        $this->testId = $id;
    }

    /**
     * Get deployed
     *
     * @return  boolean
     */ 
    public function getDeployed()
    {
        return $this->deployed;
    }

    /**
     * Set deployed
     *
     * @param  boolean  $deployed  Deployed
     *
     * @return  self
     */ 
    public function setDeployed(bool $deployed)
    {
        $this->deployed = $deployed;

        return $this;
    }

    public function getDeployedAt(): string
    {
        return $this->deployedAt->format('d.m.Y H:i');
    }

    public function setDeployedAt(string $date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $date);

        $this->deployedAt = $dateTime;
    }

}