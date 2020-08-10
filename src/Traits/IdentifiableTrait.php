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

use Doctrine\ORM\Mapping as ORM;

trait IdentifiableTrait
{
    /**
     * Id
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * 
     * @var integer
     */
    protected int $id = 0;

    /**
     * Creator Id
     * 
     * @ORM\Column(type="integer", name="creator_id")
     * 
     * @var integer
     */
    protected int $creatorId = 0;
    
    /**
     * Priority Id
     * 
     * @ORM\Column(type="integer", name="priority_id")
     * 
     * @var integer
     */
    protected int $priorityId = 0;

    /**
     * Status Id
     * 
     * @ORM\Column(type="integer", name="status_id")
     * 
     * @var integer
     */
    protected int $statusId = 0;

    /**
     * Get the value of id
     * 
     * @return self
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of creator id
     */
    public function getCreatorId(): ?int
    {
        return $this->creatorId;
    }

    /**
     * Set the value of creator id
     * 
     * @param int $id - The id of a creator.
     */
    public function setCreatorId(int $id)
    {
        $this->creatorId = $id;
    }

    /**
     * Get the value of priority id
     * 
     * @return int 
     */
    public function getPriorityId(): int
    {
        return $this->priorityId;
    }

    /**
     * Set the value of priority id
     * 
     * @param int $id - Set priority id
     */
    public function setPriorityId(int $id)
    {
        $this->priorityId = $id;
    }

    /**
     * Get the value of status id
     * 
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    /**
     * Set the value of status id
     */
    public function setStatusId(int $id)
    {
        $this->statusId = $id;
    }
}