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

namespace App\Modules\Task\Controller;

use App\Library\Application;
use App\Library\Controller;

class Task extends Controller{

    protected $model = null;

    public function __construct()
    {
        $this->model = $this->model(new \App\Modules\Task\Model\TaskModel);
    }

    /**
     * Shows all active tasks.
     */
    public function index(): void
    {
        $tasks = $this->model->findAllTasks();

        $this->render('task/index', ['tasks' => $tasks]);
    }

    /**
     * Create a new task
     */
    public function create(): void
    {
        $this->model->create($_POST);

        Application::redirect('tasks');
    }

    public function read($id): void
    {
        $task = $this->model->read($id);

        $this->render('/task/read', $task);
    }

    public function update(): void
    {
        $this->model->update($_POST);

        Application::redirect('tasks');
    }

    public function delete(): void
    {
        $this->render('/task/delete');
    }

    public function new(): void
    {
        $data = [
            'contactList' => $this->model->getContactList(),
            'priorityList' => $this->model->getPriorityList(),
            'statusList' => $this->model->getStatusList(),
            'projectList' => $this->model->getProjectList()
        ];

        $this->render('/task/new', $data);
    }

    public function edit($id): void
    {
        $data = [
            'task' => $this->model->read($id),
            'contactList' => $this->model->getContactList(),
            'priorityList' => $this->model->getPriorityList(),
            'statusList' => $this->model->getStatusList()
        ];

        $this->render('/task/edit', $data);
    }
}
