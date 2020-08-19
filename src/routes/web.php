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
    $r->addRoute('GET', '/contact/new', 'App\Modules\Contact\Controller\Contact/new');
    $r->addRoute('POST', '/contact/create', 'App\Modules\Contact\Controller\Contact/create');
    $r->addRoute('GET', '/contact/read/{id:\d+}', 'App\Modules\Contact\Controller\Contact/read');
    $r->addRoute('GET', '/contact/edit/{id:\d+}', 'App\Modules\Contact\Controller\Contact/edit');
    $r->addRoute('POST', '/contact/update', 'App\Modules\Contact\Controller\Contact/update');

    /*
    |----------------------------------------------------------------------------
    | Project-Routes
    |----------------------------------------------------------------------------
    */
    $r->addRoute('GET', '/projects', 'App\Modules\Project\Controller\Project/index');
    $r->addRoute('GET', '/project/new', 'App\Modules\Project\Controller\Project/new');
    $r->addRoute('POST', '/project/create', 'App\Modules\Project\Controller\Project/create');
    $r->addRoute('GET', '/project/read/{id:\d+}', 'App\Modules\Project\Controller\Project/read');
    $r->addRoute('GET', '/project/edit/{id:\d+}', 'App\Modules\Project\Controller\Project/edit');

    /*
    |----------------------------------------------------------------------------
    | Task-Routes
    |----------------------------------------------------------------------------
    */
    $r->addRoute('GET', '/tasks', 'App\Modules\Task\Controller\Task/index');
    $r->addRoute('GET', '/task/new', 'App\Modules\Task\Controller\Task/new');
    $r->addRoute('GET', '/task/read/{id:\d+}', 'App\Modules\Task\Controller\Task/read');
    $r->addRoute('GET', '/task/edit/{id:\d+}', 'App\Modules\Task\Controller\Task/edit');
    $r->addRoute('POST', '/task/update', 'App\Modules\Task\Controller\Task/update');
    $r->addRoute('POST', '/task/create', 'App\Modules\Task\Controller\Task/create');

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
