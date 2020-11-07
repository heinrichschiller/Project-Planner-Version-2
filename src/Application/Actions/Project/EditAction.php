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

namespace App\Application\Actions\Project;

use App\Domain\Contact\Service\ContactReader;
use App\Domain\Priority\Service\PriorityFinder;
use App\Domain\Project\Service\ProjectReader;
use App\Domain\Status\Service\StatusFinder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class EditAction
{
    /**
     * @Injection
     * @var ContainerInterface
     */
    private $ci;

    /**
     * @Injection
     * @var ContactReader
     */
    private ContactReader $contactReader;

    /**
     * @Injection
     * @var PriorityFinder
     */
    private PriorityFinder $priorityFinder;

    /**
     * @Injection
     * @var ProjectReader
     */
    private ProjectReader $projectReader;

    /**
     * @Injection
     * @var StatusFinder
     */
    private StatusFinder $statusFinder;

    /**
     * The constructor
     * 
     * @param ContainerInterface $ci
     * @param ContactReader $contactReader
     * @param PriorityFinder $priorityFinder
     * @param ProjectReader $projectReader
     * @param StatusFinder $statusFinder
     */
    public function __construct(ContainerInterface $ci
        , ContactReader $contactReader
        , PriorityFinder $priorityFinder
        , ProjectReader $projectReader
        , StatusFinder $statusFinder)
    {
        $this->ci = $ci;
        $this->contactReader = $contactReader;
        $this->priorityFinder = $priorityFinder;
        $this->projectReader = $projectReader;
        $this->statusFinder = $statusFinder;
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
        $project = $this->projectReader->readProject($args['id']);
        $contactList = $this->contactReader->readContact($args['id']);
        $priorityList = $this->priorityFinder->findAll();
        $statusList = $this->statusFinder->findAll();

        $data = [
            'project' => $project,
            'contactList' => $contactList,
            'priorityList' => $priorityList,
            'statusList' => $statusList
        ];

        $html = $this->ci->get('view')->render('project/edit', $data);

        $response->getBody()->write($html);

        return $response;
    }
}