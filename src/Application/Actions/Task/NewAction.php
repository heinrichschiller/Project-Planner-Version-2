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

namespace App\Application\Actions\Task;

use App\Application\Actions\Action;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class NewAction extends Action
{
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $contactList = $this->entityManager()
            ->getRepository('Entities\Contact')
            ->findAll();

        $projectList = $this->entityManager()
            ->getRepository(('Entities\Project'))
            ->findAll();

        $statusList =  $this->entityManager()
            ->getRepository('Entities\Status')
            ->findAll();

        $priorityList = $this->entityManager()
            ->getRepository('Entities\Priority')
            ->findAll();

        $data = [
            'contactList' => $contactList,
            'priorityList' => $priorityList,
            'statusList' => $statusList,
            'projectList' => $projectList
        ];
        
        return $this->render($response, 'task/new', $data);
    }
}