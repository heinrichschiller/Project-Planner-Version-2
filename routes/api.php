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
    $app->get('/api/v1/dashboard', \App\Application\Actions\Dashboard\DashboardAction::class);

    /*
    |----------------------------------------------------------------------------
    | Contact routes
    |----------------------------------------------------------------------------
    */
    $app->get('/api/v1/contacts', \App\Application\Actions\Contact\ContactAction::class);
    $app->get('/api/v1/contacts/{id:\d+}/read', \App\Application\Actions\Contact\ReadAction::class);
    $app->get('/api/v1/contacts/{id:\d+}/edit', \App\Application\Actions\Contact\EditAction::class);
    $app->post('/api/v1/contacts',  \App\Application\Actions\Contact\CreateAction::class);
    $app->patch('/api/v1/contacts', \App\Application\Actions\Contact\UpdateAction::class);

    /*
    |----------------------------------------------------------------------------
    | Email routes
    |----------------------------------------------------------------------------
    */
    // TODO: rewrite code to api
    $app->get('/api/v1/emails', \App\Application\Actions\Email\EmailAction::class);

    /*
    |----------------------------------------------------------------------------
    | Calendar routes
    |----------------------------------------------------------------------------
    */
    // TODO: rewrite code to api
    $app->get('/api/v1/calendars', \App\Application\Actions\Calendar\CalendarAction::class);

    /*
    |----------------------------------------------------------------------------
    | Document routes
    |----------------------------------------------------------------------------
    */
    // TODO: rewrite code to api
    $app->get('/api/v1/documents', \App\Application\Actions\Document\DocumentAction::class);

    /*
    |----------------------------------------------------------------------------
    | Issue routes
    |----------------------------------------------------------------------------
    */
    // TODO: rewrite code to api
    $app->get('/api/v1/issues', \App\Application\Actions\Issue\IssueAction::class);

    /*
    |----------------------------------------------------------------------------
    | Project routes
    |----------------------------------------------------------------------------
    */
    $app->get('/api/v1/projects', \App\Application\Actions\Project\ProjectAction::class);
    $app->get('/api/v1/projects/{id:\d+}/read', \App\Application\Actions\Project\ReadAction::class);
    $app->get('/api/v1/projects/{id:\d+}/edit', \App\Application\Actions\Project\EditAction::class);
    $app->post('/api/v1/projects', \App\Application\Actions\Project\CreateAction::class);
    $app->patch('/api/v1/projects',  \App\Application\Actions\Project\UpdateAction::class);

    /*
    |----------------------------------------------------------------------------
    | Task routes
    |----------------------------------------------------------------------------
    */
    $app->get('/api/v1/tasks',  \App\Application\Actions\Task\TaskAction::class);
    $app->get('/api/v1/tasks/{id:\d+}/read', \App\Application\Actions\Task\ReadAction::class);
    $app->get('/api/v1/tasks/{id:\d+}/edit', \App\Application\Actions\Task\EditAction::class);
    $app->post('/api/v1/tasks', \App\Application\Actions\Task\CreateAction::class);
    $app->patch('/api/v1/tasks', \App\Application\Actions\Task\UpdateAction::class);

    /*
    |----------------------------------------------------------------------------
    | Test routes
    |----------------------------------------------------------------------------
    */
    $app->get('/api/v1/tests', \App\Application\Actions\Test\TestAction::class);

    /*
    |----------------------------------------------------------------------------
    | Timetrack routes
    |----------------------------------------------------------------------------
    */
    $app->get('/api/v1/timetracks', \App\Application\Actions\Timetrack\TimetrackAction::class);

    /*
    |----------------------------------------------------------------------------
    | Tool routes
    |----------------------------------------------------------------------------
    */
    $app->get('/api/v1/tools', \App\Application\Actions\Tool\ToolAction::class);

    /*
    |----------------------------------------------------------------------------
    | Note routes
    |----------------------------------------------------------------------------
    */
    $app->get('/api/v1/notes', \App\Application\Actions\Note\NoteAction::class);

    /*
    |----------------------------------------------------------------------------
    | Notes routes (deprecated)
    |----------------------------------------------------------------------------
    */
    $app->get('/api/contact/notes/{cid:\d+}', \App\Application\Actions\Note\ContactNotesAction::class);
    $app->get('/api/project/notes/{pid:\d+}', \App\Application\Actions\Note\ProjectNotesAction::class);
    $app->get('/api/project/task/notes/{pid:\d+}/{tid:\d+}', \App\Application\Actions\Note\ProjectTaskNotesAction::class);
    $app->post('/api/note/create', \App\Application\Actions\Note\CreateAction::class);

    /*
    |----------------------------------------------------------------------------
    | Settings routes
    |----------------------------------------------------------------------------
    */
    $app->get('/api/v1/settings', \App\Application\Actions\Settings\SettingsAction::class);
};