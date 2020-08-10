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

namespace Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableTrait
{
    /**
     * Begin
     * 
     * @ORM\Column(type="datetime", name="begin_at")
     * 
     * @var DateTime
     */
    protected DateTime $beginAt;
    
    /**
     * End
     * 
     * @ORM\Column(type="datetime", name="end_at")
     * 
     * @var Datetime
     */
    protected DateTime $endAt;

    /**
     * Created at
     * 
     * @ORM\Column(type="datetime", name="created_at")
     * 
     * @var DateTime
     */
    protected DateTime $createdAt;
    
    /**
     * Updated At
     * 
     * @ORM\Column(type="datetime", name="updated_at", options={"default": "CURRENT_TIMESTAMP"})
     * 
     * @var DateTime
     */
    protected DateTime $updatedAt;

    /**
     * Get the value of beginAt
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
     * Set the value of beginAt
     * 
     * @param string $date - The begining of a task.
     */
    public function setBeginAt(string $date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $date);
        
        $this->beginAt = $dateTime;
    }

    /**
     * Get the value of endAt
     */
    public function getEndAt(): string
    {
        return $this->endAt->format('d.m.Y H:i');
    }

    /**
     * Get the value of endAt
     */
    public function getEndAtDateTimeLocal(): string
    {
        return $this->endAt->format('Y-m-d\TH:i');
    }

    /**
     * Set the value of endAt
     * 
     * @param string $date - The begining of a task.
     */
    public function setEndAt(string $date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $date);

        $this->endAt = $dateTime;
    }
    
    public function getCreatedAt(): string
    {
        return $this->createdAt->format('d.m.Y H:i');
    }

    public function setCreatedAt($date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $date);

        $this->createdAt = $dateTime;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt->format('d.m.Y H:i');
    }

    public function setUpdatedAt()
    {        
        $this->updatedAt = new DateTime;
    }

}