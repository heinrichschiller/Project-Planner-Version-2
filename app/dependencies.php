<?php

/**
 * MIT License
 *
 * Copyright (c) 2020 - 2021 Heinrich Schiller
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

declare(strict_types=1);

use App\Application\Actions\Calendar\CalendarAction;
use App\Application\Actions\Contact\ContactAction;
use App\Application\Actions\Contact\EditAction as ContactEditAction;
use App\Application\Actions\Contact\NewAction as ContactNewAction;
use App\Application\Actions\Contact\ReadAction as ContactReadAction;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use App\Application\Actions\Dashboard\DashboardAction;
use App\Application\Actions\Document\DocumentAction;
use App\Application\Actions\Email\EmailAction;
use App\Application\Actions\Issue\IssueAction;
use App\Application\Actions\Note\NoteAction;
use App\Application\Actions\Project\EditAction as ProjectEditAction;
use App\Application\Actions\Project\NewAction as ProjectNewAction;
use App\Application\Actions\Project\ProjectAction;
use App\Application\Actions\Project\ReadAction as ProjectReadAction;
use App\Application\Actions\Settings\SettingsAction;
use App\Application\Actions\Task\EditAction as TaskEditAction;
use App\Application\Actions\Task\NewAction as TaskNewAction;
use App\Application\Actions\Task\NewProjectTaskAction;
use App\Application\Actions\Task\ReadAction as TaskReadAction;
use App\Application\Actions\Task\TaskAction;
use App\Application\Actions\Test\TestAction;
use App\Application\Actions\Timetrack\TimetrackAction;
use App\Application\Actions\Tool\ToolAction;
use App\Domain\Contact\Repository\ContactCreatorRepository;
use App\Domain\Contact\Repository\ContactFinderRepository;
use App\Domain\Contact\Repository\ContactReaderRepository;
use App\Domain\Contact\Repository\ContactUpdatingRepository;
use App\Domain\Contact\Service\ContactCreator;
use App\Domain\Contact\Service\ContactFinder;
use App\Domain\Contact\Service\ContactReader;
use App\Domain\Dashboard\Service\ImportantProjectFinder;
use App\Domain\Dashboard\Service\ImportantTaskFinder;
use App\Domain\Note\Repository\NoteCreatorRepository;
use App\Domain\Priority\Repository\PriorityFinderRepository;
use App\Domain\Priority\Service\PriorityFinder;
use App\Domain\Project\Repository\ProjectCreatorRepository;
use App\Domain\Project\Repository\ProjectFinderRepository;
use App\Domain\Project\Repository\ProjectReaderRepository;
use App\Domain\Project\Repository\ProjectTaskReaderRepository;
use App\Domain\Project\Repository\ProjectUpdatingRepository;
use App\Domain\Project\Service\ProjectCreator;
use App\Domain\Project\Service\ProjectFinder;
use App\Domain\Project\Service\ProjectReader;
use App\Domain\Project\Service\ProjectTaskReader;
use App\Domain\Project\Service\ProjectUpdating;
use App\Domain\Status\Repository\StatusFinderRepository;
use App\Domain\Status\Service\StatusFinder;
use App\Domain\Task\Repository\TaskFinderRepository;
use App\Domain\Task\Repository\TaskReaderRepository;
use App\Domain\Task\Repository\TaskUpdatingRepository;
use App\Domain\Task\Service\TaskFinder;
use App\Domain\Task\Service\TaskReader;
use Cake\Validation\Validator;
use Doctrine\ORM\EntityManager;
use Entities\Project;
use Psr\Log\LoggerInterface;
use Slim\Views\Mustache;

return function(ContainerBuilder $builder)
{
    $builder->addDefinitions([

        CalendarAction::class => function(ContainerInterface $container): CalendarAction
        {
            return new CalendarAction(
                $container->get(Mustache::class)
            );
        },

        ContactAction::class => function(ContainerInterface $container): ContactAction
        {
            return new ContactAction(
                $container->get(ContactFinder::class)
            );
        },

        ContactCreator::class => function(ContainerInterface $container): ContactCreator
        {
            return new ContactCreator(
                $container->get(ContactCreatorRepository::class),
                $container->get(LoggerInterface::class),
                $container->get(Validator::class)
            );
        },

        ContactCreatorRepository::class => function(ContainerInterface $container): ContactCreatorRepository
        {
            return new ContactCreatorRepository(
                $container->get(EntityManager::class)
            );
        },

        ContactReadAction::class => function(ContainerInterface $container): ContactReadAction
        {
            return new ContactReadAction(
                $container->get(ContactReader::class)
            );
        },

        ContactEditAction::class => function(ContainerInterface $container): ContactEditAction
        {
            return new ContactEditAction(
                $container->get(ContactReader::class)
            );
        },

        ContactFinderRepository::class => function(ContainerInterface $container): ContactFinderRepository
        {
            return new ContactFinderRepository(
                $container->get(EntityManager::class)
            );
        },

        ContactNewAction::class => function(ContainerInterface $container): ContactNewAction
        {
            return new ContactNewAction(
                $container->get(Mustache::class)
            );
        },

        ContactReaderRepository::class => function(ContainerInterface $container): ContactReaderRepository
        {
            return new ContactReaderRepository(
                $container->get(EntityManager::class)
            );
        },

        ContactUpdatingRepository::class => function(ContainerInterface $container): ContactUpdatingRepository
        {
            return new ContactUpdatingRepository(
                $container->get(EntityManager::class)
            );
        },

        DashboardAction::class => function(ContainerInterface $container): DashboardAction
        {
            return new DashboardAction(
                $container->get(ImportantProjectFinder::class),
                $container->get(ImportantTaskFinder::class)
            );
        },

        EmailAction::class => function(ContainerInterface $container): EmailAction
        {
            return new EmailAction(
                $container->get(Mustache::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Document dependencies
        |----------------------------------------------------------------------------
        */

        DocumentAction::class => function(ContainerInterface $container): DocumentAction
        {
            return new DocumentAction(
                $container->get(Mustache::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Issues dependencies
        |----------------------------------------------------------------------------
        */

        IssueAction::class => function(ContainerInterface $container): IssueAction
        {
            return new IssueAction(
                $container->get(Mustache::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Note dependencies
        |----------------------------------------------------------------------------
        */

        NoteAction::class => function(ContainerInterface $container): NoteAction
        {
            return new NoteAction(
                $container->get(Mustache::class)
            );
        },
        
        NoteCreatorRepository::class => function(ContainerInterface $container): NoteCreatorRepository
        {
            return new NoteCreatorRepository(
                $container->get(EntityManager::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Project dependencies
        |----------------------------------------------------------------------------
        */

        ProjectAction::class => function(ContainerInterface $container): ProjectAction
        {
            return new ProjectAction(
                $container->get(ProjectFinder::class)
            );
        },

        ProjectNewAction::class => function(ContainerInterface $container): ProjectNewAction
        {
            return new ProjectNewAction(
                $container->get(ContactFinder::class),
                $container->get(PriorityFinder::class),
                $container->get(StatusFinder::class),
                $container->get(Mustache::class)
            );
        },

        NewProjectTaskAction::class => function(ContainerInterface $container): NewProjectTaskAction
        {
            return new NewProjectTaskAction(
                $container->get(ContactFinder::class),
                $container->get(PriorityFinder::class),
                $container->get(ProjectFinder::class),
                $container->get(ProjectReader::class),
                $container->get(StatusFinder::class),
                $container->get(Mustache::class)
            );
        },

        ProjectReadAction::class => function(ContainerInterface $container): ProjectReadAction
        {
            return new ProjectReadAction(
                $container->get(ProjectReader::class),
                $container->get(ProjectTaskReader::class)
            );
        },

        ProjectEditAction::class => function(ContainerInterface $container): ProjectEditAction
        {
            return new ProjectEditAction(
                $container->get(Mustache::class),
                $container->get(PriorityFinder::class),
                $container->get(ProjectReader::class),
                $container->get(StatusFinder::class)
            );
        },

        ProjectCreatorRepository::class => function(ContainerInterface $container): ProjectCreatorRepository
        {
            return new ProjectCreatorRepository(
                $container->get(EntityManager::class),
                $container->get(Project::class)
            );
        },

        ProjectCreator::class => function(ContainerInterface $container): ProjectCreator
        {
            return new ProjectCreator(
                $container->get(ProjectCreatorRepository::class),
                $container->get(LoggerInterface::class),
                $container->get(Validator::class)
            );
        },

        ProjectFinderRepository::class => function(ContainerInterface $container): ProjectFinderRepository
        {
            return new ProjectFinderRepository(
                $container->get(EntityManager::class)
            );
        },

        ProjectReaderRepository::class => function(ContainerInterface $container): ProjectReaderRepository
        {
            return new ProjectReaderRepository(
                $container->get(EntityManager::class)
            );
        },

        ProjectTaskReaderRepository::class => function(ContainerInterface $container): ProjectTaskReaderRepository
        {
            return new ProjectTaskReaderRepository(
                $container->get(EntityManager::class)
            );
        },

        ProjectUpdatingRepository::class => function(ContainerInterface $container): ProjectUpdatingRepository
        {
            return new ProjectUpdatingRepository(
                $container->get(EntityManager::class)
            );
        },

        ProjectUpdating::class => function(ContainerInterface $container): ProjectUpdating
        {
            return new ProjectUpdating(
                $container->get(ProjectUpdatingRepository::class),
                $container->get(LoggerInterface::class),
                $container->get(Validator::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Priority dependencies
        |----------------------------------------------------------------------------
        */

        PriorityFinderRepository::class => function(ContainerInterface $container): PriorityFinderRepository
        {
            return new PriorityFinderRepository(
                $container->get(EntityManager::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Settings dependencies
        |----------------------------------------------------------------------------
        */

        SettingsAction::class => function(ContainerInterface $container): SettingsAction
        {
            return new SettingsAction(
                $container->get(Mustache::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Status dependencies
        |----------------------------------------------------------------------------
        */

        StatusFinderRepository::class => function(ContainerInterface $container): StatusFinderRepository
        {
            return new StatusFinderRepository(
                $container->get(EntityManager::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Task dependencies
        |----------------------------------------------------------------------------
        */

        TaskAction::class => function(ContainerInterface $container): TaskAction
        {
            return new TaskAction(
                $container->get(TaskFinder::class),
                $container->get(Mustache::class)
            );
        },

        TaskEditAction::class => function(ContainerInterface $container): TaskEditAction
        {
            return new TaskEditAction(
                $container->get(PriorityFinder::class),
                $container->get(StatusFinder::class),
                $container->get(TaskReader::class),
                $container->get(Mustache::class)
            );
        },

        TaskNewAction::class => function(ContainerInterface $container): TaskNewAction
        {
            return new TaskNewAction(
                $container->get(ContactFinder::class),
                $container->get(ProjectFinder::class),
                $container->get(PriorityFinder::class),
                $container->get(StatusFinder::class),
                $container->get(Mustache::class)
            );
        },

        TaskReadAction::class => function(ContainerInterface $container): TaskReadAction
        {
            return new TaskReadAction(
                $container->get(TaskReader::class),
                $container->get(Mustache::class)
            );
        },

        TaskFinderRepository::class => function(ContainerInterface $container): TaskFinderRepository
        {
            return new TaskFinderRepository(
                $container->get(EntityManager::class)
            );
        },

        TaskReaderRepository::class => function(ContainerInterface $container): TaskReaderRepository
        {
            return new TaskReaderRepository(
                $container->get(EntityManager::class)
            );
        },

        TaskUpdatingRepository::class => function(ContainerInterface $container): TaskUpdatingRepository
        {
            return new TaskUpdatingRepository(
                $container->get(EntityManager::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Test dependencies
        |----------------------------------------------------------------------------
        */

        TestAction::class => function(ContainerInterface $container): TestAction
        {
            return new TestAction(
                $container->get(Mustache::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Timetrack dependencies
        |----------------------------------------------------------------------------
        */

        TimetrackAction::class => function(ContainerInterface $container): TimetrackAction
        {
            return new TimetrackAction(
                $container->get(Mustache::class)
            );
        },

        /*
        |----------------------------------------------------------------------------
        | Tool dependencies
        |----------------------------------------------------------------------------
        */

        ToolAction::class => function(ContainerInterface $container): ToolAction
        {
            return new ToolAction(
                $container->get(Mustache::class)
            );
        }
    ]);
};