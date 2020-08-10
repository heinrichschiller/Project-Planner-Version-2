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

trait PropertiesableTrait
{
    /**
     * Title
     * 
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    protected string $title = '';
    
    /**
     * Description
     * 
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    protected string $description = '';

    /**
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     * 
     * @param string $title - The title of a task.
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get the value of desc
     * 
     * @return self
     */ 
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of desc
     *
     * @param string $desc - The description of a task.
     */ 
    public function setDescription(string $desc)
    {
        $this->description = $desc;
    }
}