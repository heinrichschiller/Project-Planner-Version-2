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

require_once __DIR__ . '/libraries/Base.php';
require_once __DIR__ . '/libraries/Database.php';
require_once __DIR__ . '/libraries/ProjectPlanner.php';

require_once __DIR__ . '/Controller/DashboardController.php';
require_once __DIR__ . '/Controller/ContactController.php';
require_once __DIR__ . '/Controller/ProjectController.php';
require_once __DIR__ . '/Controller/TaskController.php';
require_once __DIR__ . '/Controller/NotesController.php';
require_once __DIR__ . '/Controller/UserController.php';

require_once __DIR__ . '/View/View.php';

/*
function autoloader($class)
{
    $newName  = str_replace('\\', '/', $class);
    $libPath  = __DIR__ . "/libraries/$newName.php";
    $ctrlPath = __DIR__ . "/$newName.php";

    if(!class_exists($class)) {
        if(file_exists($libPath)) {
            require $libPath;
        } else {
            require $ctrlPath;
        }
    }
}

 spl_autoload_register('autoloader');
*/
