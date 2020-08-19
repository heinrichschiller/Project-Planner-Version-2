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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * 
     * @var int
     */
    protected int $id = 0;

    /**
     * @ORM\Column(type="string", name="display_name")
     * 
     * @var string
     */
    protected string $displayName = '';

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * 
     * @var DateTime
     */
    protected ?DateTime $createdAt = null;

    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     * 
     * @var DateTime
     */
    protected ?DateTime $updatedAt = null;

    /**
     * Assigned projects
     * 
     * @ORM\OneToMany(targetEntity="Project", mappedBy="Contact")
     */
    protected $assignedProjects;

    public function __construct()
    {
        $this->assignedProjects = new ArrayCollection;
    }
    
    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of displayName
     *
     * @return  string
     */ 
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * Set the value of displayName
     *
     * @param  string  $displayName
     */ 
    public function setDisplayName(string $displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * Get the value of createdAt
     *
     * @return  string
     */ 
    public function getCreatedAt(): string
    {
        return $this->createdAt->format('d.m.Y H:i');
    }

    /**
     * Set the value of createdAt
     *
     * @param  DateTime  $createdAt
     */ 
    public function setCreatedAt(?DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get the value of updatedAt
     *
     * @return  
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
     * Set the value of updatedAt
     *
     * @param  DateTime  $updatedAt
     */ 
    public function setUpdatedAt(?DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function assignedToProject(Project $project)
    {
        $this->assignedProjects[] = $project;
    }
}
