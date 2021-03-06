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

declare(strict_types = 1);

namespace App\Application\Actions\Dashboard;

use App\Domain\Dashboard\Service\ImportantProjectFinder;
use App\Domain\Dashboard\Service\ImportantTaskFinder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Mustache;

class DashboardAction
{
    /**
     * @Injection
     * @var ImportantProjectFinder
     */
    private ImportantProjectFinder $projectFinder;

    private ImportantTaskFinder $taskFinder;

    /**
     * @Injection
     * @var Mustache
     */
    private $view;

    /**
     * The constructor
     * 
     * @param ImportantProjectFinder $projectFinder
     * @param ImportantTaskFinder $taskFinder
     * @param Mustache $view Mustache-Engine
     */
    public function __construct(ImportantProjectFinder $projectFinder, ImportantTaskFinder $taskFinder, Mustache $view)
    {
        $this->projectFinder = $projectFinder;
        $this->taskFinder = $taskFinder;
        $this->view = $view;
    }

    /**
     * The invoker
     * 
     * @param Request $request
     * @param Response $response
     * @param array<mixed> $args
     * 
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $projects = (array) $this->projectFinder->findAll();
        $hasProjects = !empty($projects) ? true : false;

        $tasks = (array) $this->taskFinder->findAll();
        $hasTasks = !empty($tasks) ? true : false;

        $viewData = [
            'projects'    => $projects,
            'hasProjects' => $hasProjects,
            'tasks'       => $tasks,
            'hasTasks'    => $hasTasks
        ];

        $this->view->render($response, 'dashboard/index', $viewData);

        return $response;
    }
}