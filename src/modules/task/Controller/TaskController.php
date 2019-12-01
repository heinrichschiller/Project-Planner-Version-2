<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2019 Heinrich Schiller
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

namespace ProjectPlanner\Controller;

use ProjectPlanner\Interfaces\ControllerInterface;
use ProjectPlanner\Library\Controller;
use ProjectPlanner\Model\TaskModel;

class TaskController extends Controller implements ControllerInterface
{
    private $_model = null;

    public function __construct()
    {
        $this->_model = $this->model('TaskModel');
    }

    /**
     * Shows all active tasks.
     * 
     * @return string   string with rendered html-template of tasks
     */
    public function indexAction(): string
    {
        //$tasks = $this->_model->readAll();
//var_dump($tasks);
        return $this->render('/task/index', ['text' => 'huhu']);
    }

    public function createAction(): string
    {
        return $this->render('/task/create');
    }

    public function readAction(): string
    {
        return $this->render('/task/read');
    }

    public function updateAction(): string
    {
        return $this->render('/task/update');
    }

    public function deleteAction(): string
    {
        return $this->render('/task/delete');
    }
}
