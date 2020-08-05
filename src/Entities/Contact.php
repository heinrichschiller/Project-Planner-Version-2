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
 * @ORM\Table(name="contacts")
 */
class Contact
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
    private int $id = 0;

    /**
     * Title
     * 
     * @ORM\Column(type="string", length=255, name="display_name")
     * 
     * @var string
     */
    private string $displayName = '';

    /**
     * Creator id
     * 
     * @ORM\Column(type="integer")
     * 
     * @var int
     */
    private int $creatorId = 0;

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
     * @ORM\Column(type="datetime", name="updated_at", options={"default": "CURRENT_TIMESTAMP"})
     * 
     * @var DateTime
     */
    private DateTime $updatedAt;

    /**
     * Get id
     *
     * @return int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get display name
     *
     * @return string
     */ 
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * Set display name
     *
     * @param string $displayName Display name
     */ 
    public function setDisplayName(string $displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * Get creator id
     * 
     * @return string
     */
    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    /**
     * Set creator id
     * 
     * @param int $id ID
     */
    public function setCreatorId(int $id)
    {
        $this->creatorId = $id;
    }

    /**
     * Createt at
     * 
     * @return string
     */
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