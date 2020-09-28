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


/*
|----------------------------------------------------------------------------
| Index route
|----------------------------------------------------------------------------
*/
$app->get('/', App\Application\Actions\Dashboard\DashboardAction::class);

/*
|----------------------------------------------------------------------------
| Contact-Routes
|----------------------------------------------------------------------------
*/
$app->get('/contacts', App\Application\Actions\Contact\ContactAction::class);
$app->get('/contact/new', 'App\Modules\Contact\Controller\Contact:new');
$app->get('/contact/read/{id:\d+}', 'App\Modules\Contact\Controller\Contact:read');
$app->get('/contact/edit/{id:\d+}', 'App\Modules\Contact\Controller\Contact:edit');
$app->post('/contact/create', 'App\Modules\Contact\Controller\Contact:create');
$app->post('/contact/update', 'App\Modules\Contact\Controller\Contact:update');

/*
|----------------------------------------------------------------------------
| Project-Routes
|----------------------------------------------------------------------------
*/
$app->get('/projects', 'App\Modules\Project\Controller\Project:index');
$app->get('/project/new', 'App\Modules\Project\Controller\Project:new');
$app->get('/project/read/{id:\d+}', 'App\Modules\Project\Controller\Project:read');
$app->get('/project/edit/{id:\d+}', 'App\Modules\Project\Controller\Project:edit');
$app->post('/project/create', 'App\Modules\Project\Controller\Project:create');
$app->post('/project/update', 'App\Modules\Project\Controller\Project:update');

/*
|----------------------------------------------------------------------------
| Task-Routes
|----------------------------------------------------------------------------
*/
$app->get('/tasks', 'App\Modules\Task\Controller\Task:index');
$app->get('/task/new', 'App\Modules\Task\Controller\Task:new');
$app->get('/task/newProjectTask/{id:\d+}', 'App\Modules\Task\Controller\Task:newProjectTask');
$app->get('/task/read/{id:\d+}', 'App\Modules\Task\Controller\Task:read');
$app->get('/task/edit/{id:\d+}', 'App\Modules\Task\Controller\Task:edit');
$app->post('/task/update', 'App\Modules\Task\Controller\Task/update');
$app->post('/task/create', 'App\Modules\Task\Controller\Task/create');

/*
|----------------------------------------------------------------------------
| Document-Routes
|----------------------------------------------------------------------------
*/
$app->get('/documents', 'App\Modules\Document\Controller\Document:index');

/*
|----------------------------------------------------------------------------
| Note-Routes
|----------------------------------------------------------------------------
*/
$app->get('GET', '/notes', 'App\Modules\Note\Controller\Note:index');

/*
|----------------------------------------------------------------------------
| Timetrack-Routes
|----------------------------------------------------------------------------
*/
$app->get('/timetrack', 'App\Modules\Timetrack\Controller\Timetrack:index');


