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
    | Project routes
    |----------------------------------------------------------------------------
    */
    $app->get('/project/task/new/{pid:\d+}', \App\Application\Actions\Task\NewProjectTaskAction::class);
    $app->get('/project/task/read/{pid:\d+}', \App\Application\Actions\Project\ReadProjectTaskAction::class);
    $app->post('/project/task/create', \App\Application\Actions\Project\CreateProjectTaskAction::class);

    /*
    |----------------------------------------------------------------------------
    | Task routes
    |----------------------------------------------------------------------------
    */
    $app->get('/task/new', \App\Application\Actions\Task\NewAction::class);
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
