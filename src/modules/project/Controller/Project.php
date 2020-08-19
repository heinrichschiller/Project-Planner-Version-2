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

declare( strict_types = 1 );

namespace App\Modules\Project\Controller;

use App\Library\Controller;

class Project extends Controller
{
    protected $model = null;

    public function __construct()
    {
        $this->model = $this->model(new \App\Modules\Project\Model\ProjectModel);
    }

    public function index(): void
    {
        $projects = $this->model->findAllProjects();

        $this->render('project/index', ['projects' => $projects]);
    }

    public function create(): void
    {
        dd($_POST);
    }

    public function read(): void
    {
        
    }

    public function update(): void
    {
        
    }

    public function delete(): void
    {
        
    }

    public function new()
    {
        $data = [
            'contactList' => $this->model->getContactList(),
            'priorityList' => $this->model->getPriorityList(),
            'statusList' => $this->model->getStatusList()
        ];

        $this->render('project\new', $data);
    }
}
