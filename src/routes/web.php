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

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    /*
    |----------------------------------------------------------------------------
    | Index route
    |----------------------------------------------------------------------------
    */
    $r->addRoute('GET', '/', 'App\Modules\Dashboard\Controller\Dashboard/index');

    /*
    |----------------------------------------------------------------------------
    | Contact-Routes
    |----------------------------------------------------------------------------
    */
    $r->addRoute('GET', '/contacts', 'App\Modules\Contact\Controller\Contact/index');

    /*
    |----------------------------------------------------------------------------
    | Project-Routes
    |----------------------------------------------------------------------------
    */
    $r->addRoute('GET', '/projects', 'App\Modules\Project\Controller\Project/index');

    /*
    |----------------------------------------------------------------------------
    | Task-Routes
    |----------------------------------------------------------------------------
    */
    $r->addRoute('GET', '/tasks', 'App\Modules\Task\Controller\Task/index');
    $r->addRoute('GET', '/tasks/new', 'App\Modules\Task\Controller\Task/new');

    /*
    |----------------------------------------------------------------------------
    | Document-Routes
    |----------------------------------------------------------------------------
    */
    $r->addRoute('GET', '/documents', 'App\Modules\Document\Controller\Document/index');

    /*
    |----------------------------------------------------------------------------
    | Note-Routes
    |----------------------------------------------------------------------------
    */
    $r->addRoute('GET', '/notes', 'App\Modules\Note\Controller\Note/index');

    /*
    |----------------------------------------------------------------------------
    | Timetrack-Routes
    |----------------------------------------------------------------------------
    */
    $r->addRoute('GET', '/timetrack', 'App\Modules\Timetrack\Controller\Timetrack/index');

});
