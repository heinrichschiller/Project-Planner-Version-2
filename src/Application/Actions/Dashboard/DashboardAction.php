<?php

declare(strict_types = 1);

namespace App\Application\Actions\Dashboard;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class DashboardAction
{
    private $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $html = $this->ci->get('view')->render('dashboard/index');
        $response->getBody()->write($html);

        return $response;
    }
}