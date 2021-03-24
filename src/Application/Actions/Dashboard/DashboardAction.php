<?php

declare(strict_types = 1);

namespace App\Application\Actions\Dashboard;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Mustache;

class DashboardAction
{
    /**
     * @Injection
     * @var Mustache
     */
    private $view;

    /**
     * The constructor
     * 
     * @param Mustache $view Mustache-Engine
     */
    public function __construct(Mustache $view)
    {
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
        $this->view->render($response, 'dashboard/index');

        return $response;
    }
}