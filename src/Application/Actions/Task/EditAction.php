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

namespace App\Application\Actions\Task;

use App\Domain\Priority\Service\PriorityFinder;
use App\Domain\Status\Service\StatusFinder;
use App\Domain\Task\Service\TaskReader;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Mustache;

class EditAction
{
    /**
     * @Injection
     * @var PriorityFinder
     */
    private PriorityFinder $priorityFinder;

    /**
     * @Injection
     * @var StatusFinder
     */
    private StatusFinder $statusFinder;

    /**
     * @Injection
     * @var TaskReader
     */
    private TaskReader $taskReader;

    /**
     * @Injection
     * @var Mustache
     */
    private Mustache $view;

    /**
     * The constructor
     * 
     * @param PriorityFinder $priorityFinder
     * @param StatusFinder $statusFinder
     * @param TaskReader $taskReader
     * @param Mustache $view Mustache engine
     */
    public function __construct(
        PriorityFinder $priorityFinder,
        StatusFinder $statusFinder,
        TaskReader $taskReader,
        Mustache $view)
    {
        $this->priorityFinder = $priorityFinder;
        $this->statusFinder = $statusFinder;
        $this->taskReader = $taskReader;
        $this->view = $view;
    }

    /**
     * The invoker
     * 
     * @param Request $request
     * @param Response $response
     * @param array $args
     * 
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $task = $this->taskReader->readTask( (int) $args['id']);
        $priorityList = $this->priorityFinder->findAll();
        $statusList = $this->statusFinder->findAll();

        $data = [
            'priorityList' => $priorityList,
            'statusList' => $statusList,
            'task' => $task
        ];

        $this->view->render($response, 'task/edit', $data);
        
        return $response;
    }
}