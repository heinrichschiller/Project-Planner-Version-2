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

class Contact
{
    /**
     * Id
     * 
     * @var int
     */
    private int $id = 0;

    /**
     * Display name
     * 
     * @var string
     */
    private string $displayName = '';

    /**
     * Creator id
     * 
     * @var int
     */
    private int $creatorId = 0;

    /**
     * Created at
     * 
     * @var string
     */
    private string $createdAt = '';

    /**
     * Updated at
     * 
     * @var string
     */
    private string $updatedAt = '';

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
     * Set id
     *
     * @param int $id Id
     */ 
    public function setId(int $id)
    {
        $this->id = $id;
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
     * Get created at
     * 
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * Set created at
     * 
     * @param string $date Date
     */
    public function setCreatedAt(string $date)
    {
        $this->createdAt = $date;
    }
}