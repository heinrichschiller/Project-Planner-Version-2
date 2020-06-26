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

use ProjectPlanner\Library\Route;

Route::add('/', function() {
    $controller = new ProjectPlanner\Controller\IndexController;
    echo $controller->indexAction();
});

//
// ------------------------Contact-Routes-----------------------
//
Route::add('/contact/index', function() {
    $controller = new ProjectPlanner\Contact\ContactController;
    echo $controller->indexAction();
});

//
// ------------------------Project-Routes-----------------------
//
Route::add('/project/index', function() {
    $controller = new ProjectPlanner\Project\ProjectController;
    echo $controller->indexAction();
});

//
// --------------------------Task-Routes------------------------
//
Route::add('/task/index', function() {
    $controller = new ProjectPlanner\Task\TaskController;
    echo $controller->indexAction();
});

//
// ------------------------Document-Routes----------------------
//
Route::add('/document/index', function() {
    $controller = new ProjectPlanner\Document\DocumentController;
    echo $controller->indexAction();
});

//
// ---------------------------Note-Routes-----------------------
//
Route::add('/note/index', function() {
    $controller = new ProjectPlanner\Note\NoteController;
    echo $controller->indexAction();
});

//
// ---------------------------Timetrack-Routes-----------------------
//
Route::add('/timetrack/index', function() {
    $controller = new ProjectPlanner\Timetrack\TimetrackController;
    echo $controller->indexAction();
});

Route::run('/');