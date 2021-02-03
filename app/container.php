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

declare(strict_types = 1 );

use Psr\Container\ContainerInterface;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use App\Domain\Note\Repository\NoteCreatorRepository;
use App\Domain\Note\Repository\NoteFinderRepository;
use DI\Container;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;

return function(Container $container) 
{
    $container->set('EntityManager', function(ContainerInterface $ci) {
        $doctrineSettings = $ci->get('settings')['doctrine'];

        $config = Setup::createAnnotationMetadataConfiguration(
            array(__DIR__."/../src")
            , $doctrineSettings['dev_mode']
            , $doctrineSettings['proxy_dir']
            , $doctrineSettings['cache_dir']
            , $doctrineSettings['useSimpleAnnotationReader']
        );

        $connection = $doctrineSettings['connection'];

        return EntityManager::create($connection, $config);
    });

    $container->set(EntityManager::class, function(ContainerInterface $ci) {
        $doctrineSettings = $ci->get('settings')['doctrine'];
        
        $config = Setup::createAnnotationMetadataConfiguration(
            array(__DIR__."/../src")
            , $doctrineSettings['dev_mode']
            , $doctrineSettings['proxy_dir']
            , $doctrineSettings['cache_dir']
            , $doctrineSettings['useSimpleAnnotationReader']
        );

        $connection = $doctrineSettings['connection'];

        return EntityManager::create($connection, $config);
    });

    $container->set(NoteCreatorRepository::class, function($container) {
        return new NoteCreatorRepository($container->get(EntityManager::class));
    });

    $container->set(NoteFinderRepository::class, function($container) {
        return new NoteFinderRepository($container->get(EntityManager::class));
    });

    $container->set('logger', function(ContainerInterface $container): Logger
    {
        $loggerSettings = $container->get('settings')['logger'];

        $logger = new Logger($loggerSettings['name']);
        $logger->pushProcessor(new UidProcessor);

        $streamHandler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($streamHandler);

        return $logger;
    });

    $container->set('view', function(ContainerInterface $ci) {
        $mustacheSettings = $ci->get('settings')['mustache'];

        $options = $mustacheSettings['options'];

        $viewPath = $mustacheSettings['viewPath'];

        return new \Mustache_Engine([
            'loader' => new \Mustache_Loader_FilesystemLoader($viewPath, $options),
        ]);
    });
};