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
    use \Traits\IdentifiableTrait;
    use \Traits\PropertiesableTrait;
    use \Traits\TimestampableTrait;

    /**
     * Contact Id
     * 
     * @ORM\Column(type="integer", name="contact_id")
     *
     * @var integer
     */
    private int $contactId = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="projects")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    private $project;

    /**
     * Deployed at
     * 
     * @ORM\Column(type="datetime", name="deployed_at")
     * @var DateTime
     */
    private DateTime $deployedAt;

    /**
     * Tested
     * 
     * @ORM\Column(type="integer", name="test_id")
     * 
     * @var int
     */
    private int $testId = 0;

    public function getContactId(): int
    {
        return $this->contactId;
    }

    public function setContactId(int $id)
    {
        $this->contactId = $id;
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

    public function getTestId(): int
    {
        return $this->testId;
    }

    public function setTestId(int $id)
    {
        $this->testId = $id;
    }
}