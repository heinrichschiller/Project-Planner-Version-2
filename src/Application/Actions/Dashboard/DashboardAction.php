<?php

namespace App\Application\Actions\Dashboard;

use App\Application\Actions\Action;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class DashboardAction extends Action
{
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        return $this->render($response, 'dashboard/index');
    }
}