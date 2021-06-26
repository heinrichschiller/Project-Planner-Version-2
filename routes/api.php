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
    $app->get('/api/v1/contact/{id:\d+}/read', \App\Application\Actions\Contact\ReadAction::class);
    $app->get('/api/v1/contact/{id:\d+}/edit', \App\Application\Actions\Contact\EditAction::class);
    $app->post('/api/v1/contact',  \App\Application\Actions\Contact\CreateAction::class);
    $app->patch('/api/v1/contact', \App\Application\Actions\Contact\UpdateAction::class);

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
    $app->get('/api/v1/calendar', \App\Application\Actions\Calendar\CalendarAction::class);

    /*
    |----------------------------------------------------------------------------
    | Document routes
    |----------------------------------------------------------------------------
    */
    // TODO: rewrite code to api
    $app->get('/api/v1/documents', \App\Application\Actions\Document\DocumentAction::class);

    /*
    |----------------------------------------------------------------------------
    | Notes routes
    |----------------------------------------------------------------------------
    */
    $app->get('/api/contact/notes/{cid:\d+}', \App\Application\Actions\Note\ContactNotesAction::class);
    $app->get('/api/project/notes/{pid:\d+}', \App\Application\Actions\Note\ProjectNotesAction::class);
    $app->get('/api/project/task/notes/{pid:\d+}/{tid:\d+}', \App\Application\Actions\Note\ProjectTaskNotesAction::class);
    $app->post('/api/note/create', \App\Application\Actions\Note\CreateAction::class);
};