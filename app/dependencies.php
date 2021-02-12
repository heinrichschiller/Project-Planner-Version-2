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
use App\Application\Actions\Email\EmailAction;
use App\Domain\Contact\Repository\ContactCreatorRepository;
use App\Domain\Contact\Repository\ContactFinderRepository;
use App\Domain\Contact\Repository\ContactReaderRepository;
use App\Domain\Contact\Repository\ContactUpdatingRepository;
use App\Domain\Contact\Service\ContactFinder;
use App\Domain\Contact\Service\ContactReader;
use Doctrine\ORM\EntityManager;
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
                $container->get(ContactFinder::class),
                $container->get(Mustache::class)
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
                $container->get(ContactReader::class),
                $container->get(Mustache::class)
            );
        },

        ContactEditAction::class => function(ContainerInterface $container): ContactEditAction
        {
            return new ContactEditAction(
                $container->get(ContactReader::class),
                $container->get(Mustache::class)
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
                $container->get(Mustache::class)
            );
        },

        EmailAction::class => function(ContainerInterface $container): EmailAction
        {
            return new EmailAction(
                $container->get(Mustache::class)
            );
        }
        
    ]);
};