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

use App\Domain\Project\Service\ProjectFinder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ProjectAction
{
    /**
     * @Injection
     * @var ContainerInterface
     */
    private $ci;

    /**
     * @Injection
     * @var ProjectFinder 
     */
    private ProjectFinder $projectFinder;

    /**
     * The constructor
     * 
     * @param ContainerInterface $ci
     * @param ProjectFinder $projectFinder
     */
    public function __construct(ContainerInterface $ci, ProjectFinder $projectFinder)
    {
        $this->ci = $ci;
        $this->projectFinder = $projectFinder;
    }

    /**
     * The invoker
     * 
     * @param Request $request
     * @param Response $response
     * @param array $args
     * 
     * @return Request
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $projects = $this->projectFinder->findAll();

        $html = $this->ci->get('view')->render('project/index', ['projects' => $projects]);

        $response->getBody()->write($html);

        return $response;
    }
}