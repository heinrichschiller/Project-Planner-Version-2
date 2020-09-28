<?php

namespace App\Application\Actions;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Action
{
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    protected function render(Response $response, string $template, $data = null)
    {
        $html = $this->ci->get('view')->render($template, $data);
        $response->getBody()->write($html);

        return $response;
    }

    protected function entityManager()
    {
        return $this->ci->get('EntityManager');
    }

    abstract public function __invoke(Request $request, Response $response, $args = []);
}