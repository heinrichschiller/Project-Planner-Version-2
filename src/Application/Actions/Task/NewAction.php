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

use App\Domain\Contact\Service\ContactFinder;
use App\Domain\Priority\Service\PriorityFinder;
use App\Domain\Project\Service\ProjectFinder;
use App\Domain\Status\Service\StatusFinder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Mustache;

class NewAction
{
    /**
     * @Injection
     * @var ContactFinder
     */
    private ContactFinder $contactFinder;

    /**
     * @Injection
     * @var PriorityFinder
     */
    private PriorityFinder $priorityFinder;

    /**
     * @Injection
     * @var ProjectFinder
     */
    private ProjectFinder $projectFinder;

    /**
     * @Injection
     * @var StatusFinder
     */
    private StatusFinder $statusFinder;

    /**
     * @Injection
     * @var Mustache
     */
    private Mustache $view;

    /**
     * The constructor
     * 
     * @param ContactFinder $contactFinder
     * @param ProjectFinder $projectFinder
     * @param PriorityFinder $priorityFinder
     * @param StatusFinder $statusFinder
     * @param Mustache $view Mustache engine
     */
    public function __construct(ContactFinder $contactFinder,
        ProjectFinder $projectFinder,
        PriorityFinder $priorityFinder,
        StatusFinder $statusFinder,
        Mustache $view)
    {
        $this->contactFinder = $contactFinder;
        $this->priorityFinder = $priorityFinder;
        $this->projectFinder = $projectFinder;
        $this->statusFinder = $statusFinder;
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
    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        $contactList = $this->contactFinder->findAll();
        $priorityList = $this->priorityFinder->findAll();
        $projectList = $this->projectFinder->findAll();
        $statusList = $this->statusFinder->findAll();

        $data = [
            'contactList' => $contactList,
            'priorityList' => $priorityList,
            'statusList' => $statusList,
            'projectList' => $projectList
        ];
        
        $this->view->render($response, 'task/new', $data);

        return $response;
    }
}