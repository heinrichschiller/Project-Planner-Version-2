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

use App\Library\Controller;

class Task extends Controller{
    private $_model = null;

    public function __construct()
    {
        $this->_model = $this->model(new \App\Modules\Task\Model\TaskModel);
    }

    /**
     * Shows all active tasks.
     */
    public function index(): void
    {
        $tasks = $this->_model->getAllActiveTasks();

        echo $this->render('task/index', ['tasks' => $tasks->toArray()]);
    }

    public function create(): void
    {
        echo $this->render('/task/create');
    }

    public function read($id): void
    {
        $task = $this->_model->read($id);

        echo $this->render('/task/read', $task);
    }

    public function update(): void
    {
        echo $this->render('/task/update');
    }

    public function deleten(): void
    {
        echo $this->render('/task/delete');
    }

    public function new(): void
    {
        echo $this->render('/task/new');
    }
}
