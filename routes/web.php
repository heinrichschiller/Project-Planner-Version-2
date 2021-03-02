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

declare(strict_types = 1 );

use Slim\App;

return function(App $app)
{
    /*
    |----------------------------------------------------------------------------
    | Index routes
    |----------------------------------------------------------------------------
    */
    $app->get('/', \App\Application\Actions\Dashboard\DashboardAction::class);

    /*
    |----------------------------------------------------------------------------
    | Contact routes
    |----------------------------------------------------------------------------
    */
    $app->get('/contacts', \App\Application\Actions\Contact\ContactAction::class);
    $app->get('/contact/new', \App\Application\Actions\Contact\NewAction::class);
    $app->get('/contact/read/{id:\d+}', \App\Application\Actions\Contact\ReadAction::class);
    $app->get('/contact/edit/{id:\d+}', \App\Application\Actions\Contact\EditAction::class);
    $app->post('/contact/create',  \App\Application\Actions\Contact\CreateAction::class);
    $app->post('/contact/update', \App\Application\Actions\Contact\UpdateAction::class);

    /*
    |----------------------------------------------------------------------------
    | Email routes
    |----------------------------------------------------------------------------
    */
    $app->get('/emails', \App\Application\Actions\Email\EmailAction::class);

    /*
    |----------------------------------------------------------------------------
    | Calendar routes
    |----------------------------------------------------------------------------
    */
    $app->get('/calendar', \App\Application\Actions\Calendar\CalendarAction::class);

    /*
    |----------------------------------------------------------------------------
    | Document routes
    |----------------------------------------------------------------------------
    */
    $app->get('/documents', \App\Application\Actions\Document\DocumentAction::class);

    /*
    |----------------------------------------------------------------------------
    | Issue routes
    |----------------------------------------------------------------------------
    */
    $app->get('/issues', \App\Application\Actions\Issue\IssueAction::class);
    /*
    |----------------------------------------------------------------------------
    | Project routes
    |----------------------------------------------------------------------------
    */
    $app->get('/projects', \App\Application\Actions\Project\ProjectAction::class);
    $app->get('/project/new', \App\Application\Actions\Project\NewAction::class);
    $app->get('/project/read/{id:\d+}', \App\Application\Actions\Project\ReadAction::class);
    $app->get('/project/edit/{id:\d+}', \App\Application\Actions\Project\EditAction::class);
    $app->get('/project/task/new/{pid:\d+}', \App\Application\Actions\Task\NewProjectTaskAction::class);
    $app->post('/project/task/create', \App\Application\Actions\Project\CreateProjectTaskAction::class);
    $app->post('/project/create', \App\Application\Actions\Project\CreateAction::class);
    $app->post('/project/update',  \App\Application\Actions\Project\UpdateAction::class);

    /*
    |----------------------------------------------------------------------------
    | Task routes
    |----------------------------------------------------------------------------
    */
    $app->get('/tasks',  \App\Application\Actions\Task\TaskAction::class);
    $app->get('/task/new', \App\Application\Actions\Task\NewAction::class);
    $app->get('/task/read/{id:\d+}', \App\Application\Actions\Task\ReadAction::class);
    $app->get('/task/edit/{id:\d+}', \App\Application\Actions\Task\EditAction::class);
    $app->post('/task/update', \App\Application\Actions\Task\UpdateAction::class);
    $app->post('/task/create', \App\Application\Actions\Task\CreateAction::class);

    /*
    |----------------------------------------------------------------------------
    | Test routes
    |----------------------------------------------------------------------------
    */
    $app->get('/tests', \App\Application\Actions\Test\TestAction::class);

    /*
    |----------------------------------------------------------------------------
    | Tool routes
    |----------------------------------------------------------------------------
    */
    $app->get('/tools', \App\Application\Actions\Tool\ToolAction::class);


    /*
    |----------------------------------------------------------------------------
    | Note routes
    |----------------------------------------------------------------------------
    */
    $app->get('/notes', \App\Application\Actions\Note\NoteAction::class);

    /*
    |----------------------------------------------------------------------------
    | Timetrack routes
    |----------------------------------------------------------------------------
    */
    $app->get('/timetrack', \App\Application\Actions\Timetrack\TimetrackAction::class);

    /*
    |----------------------------------------------------------------------------
    | Settings routes
    |----------------------------------------------------------------------------
    */
    $app->get('/settings', \App\Application\Actions\Settings\SettingsAction::class);
};
