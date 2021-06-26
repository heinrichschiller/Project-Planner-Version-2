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

namespace App\Application\Actions\Project;

use App\Domain\Project\Service\ProjectReader;
use App\Domain\Project\Service\ProjectTaskReader;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ReadAction
{
    /**
     * @Injection
     * @var ProjectReader $projectReader
     */
    private ProjectReader $projectReader;

    /**
     * @Injection
     * @var ProjectTaskReader $projectTaskReader
     */
    private ProjectTaskReader $projectTaskReader;

    /**
     * The constructor
     * 
     * @param Mustache $view
     * @param ProjectReader $projectReader
     * @param ProjectTaskReader $projectTaskReader
     */
    public function __construct(
        ProjectReader $projectReader
        , ProjectTaskReader $projectTaskReader)
    {
        $this->projectReader = $projectReader;
        $this->projectTaskReader = $projectTaskReader;
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
        $project = $this->projectReader->readProject( (int) $args['id']);
        
        $tasks = $this->projectTaskReader->findOpenTasks( (int) $args['id']);
        $hasTasks = !empty($tasks) ? true : false;

        $data = [
            'project' => $project,
            'tasks'  => $tasks,
            'hasTasks' => $hasTasks
        ];

        $response->getBody()->write(json_encode($data));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}