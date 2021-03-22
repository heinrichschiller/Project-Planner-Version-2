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

namespace App\Domain\Project\Service;

use App\Domain\Project\Repository\ProjectCreatorRepository;
use App\Exception\ValidationException;
use Cake\Validation\Validator;
use Exception;
use Psr\Log\LoggerInterface;

final class ProjectCreator
{
    /**
     * @Injection
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @Injection
     * @var ProjectCreatorRepository
     */
    private ProjectCreatorRepository $repository;

    /**
     * @Injection
     * @var Validator
     */
    private Validator $validator;

    /**
     * The construct
     * 
     * @param ProjectCreatorRepository $repository
     * @param LoggerInterface $logger Monolog logger
     * @param Validator $validator CakePHP Velidator
     */
    public function __construct(
        ProjectCreatorRepository $repository, 
        LoggerInterface $logger, 
        Validator $validator)
    {
        $this->repository = $repository;
        $this->logger = $logger;
        $this->validator = $validator;
    }

    /**
     * Insert new project
     * 
     * @param array<mixed> $formData The form data
     * 
     * @return int Last insert id
     */
    public function createProject(array $formData): int
    {
        try {
            $this->validate($formData);

            $this->logger->info(sprintf('Project created: %s', $formData['title']));

            return $this->repository->createProject($formData);
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());

            throw $ex;
        }
    }

    /**
     * Input validation
     * 
     * @param array<mixed> $formData The form data
     *
     * @throws ValidationException
     * 
     * @return void
     */
    public function validate(array $formData)
    {
        $this->validator
            ->requirePresence('title')
            ->notEmptyString('title')
            ->add('title', [
                'length' => [
                    'rule' => ['minLength', 10],
                    'message' => 'Title need to be at least 10 characters long'
                ]
            ])->requirePresence('desc')
            ->notEmptyString('desc')
            ->add('desc', [
                'length' => [
                    'rule' => ['minLength', 100],
                    'message' => 'Description need to be at least 100 charachters long'
                ]
            ])->requirePresence('beginAt')
            ->notEmptyTime('beginAt')
            ->requirePresence('endAt')
            ->notEmptyTime('endAt')
            ->requirePresence('statusId')
            ->notEmptyString('statusId')
            ->requirePresence('priorityId')
            ->notEmptyString('priorityId')
            ->requirePresence('id')
            ->notEmptyString('id');

        $errors = $this->validator->validate( $formData );

        if ( $errors ) {
            throw new ValidationException('Please check your inputs: ', $errors);
        }
    }
}