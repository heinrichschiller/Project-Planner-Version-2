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

declare( strict_types = 1 );

/*
|----------------------------------------------------------------------------
| Doctrine ORM
|----------------------------------------------------------------------------
|
| Doctrine 2 is an object-relational mapper (ORM) for PHP 7.1+ that provides
| transparent persistence for PHP objects.
|
| https://www.doctrine-project.org/
|
*/
return [

    /*
    |----------------------------------------------------------------------------
    | Developer mode
    |----------------------------------------------------------------------------
    |
    | - If `isDevMode` is true caching is done in memory with the ArrayCache.
    |   Proxy objects are recreated on every request.
    | - If `isDevMode` is false, check for Caches in the order APC, Xcache, 
    |   Memcache (127.0.0.1:11211), Redis (127.0.0.1:6379) unless `$cache` 
    |   is passed as fourth argument.
    | - If `isDevMode` is false, set then proxy classes have to be explicitly 
    |   created through the command line.
    |
    */
    'dev_mode' => env('DEV_MODE'),

    /*
    |----------------------------------------------------------------------------
    | Cache
    |----------------------------------------------------------------------------
    |
    | Do not use Doctrine without a metadata and query cache! Doctrine is 
    | optimized for working with caches. The recommended cache driver to use 
    | with Doctrine is APC.
    | 
    | More Information, see Doctrine documentation:
    | https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/advanced-configuration.html
    |
    */
    'cache_dir' => env('CACHE_DIR'),
    'metadata_dirs' => env('METADATA_DIRS'),

    /*
    |----------------------------------------------------------------------------
    | Proxy directory
    |----------------------------------------------------------------------------
    |
    | If `proxyDir` is not set, use the systems temporary directory.
    |
    */
    'proxy_dir' => env('PROXY_DIR'),

    /*
    |----------------------------------------------------------------------------
    | Annotation Reader
    |----------------------------------------------------------------------------
    |
    */
    'useSimpleAnnotationReader' => env('USE_SIMPLE_ANNOTATION_READER'),

    /*
    |----------------------------------------------------------------------------
    | Connection
    |----------------------------------------------------------------------------
    |
    | More Information, see Doctrine documentation:
    | https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html 
    |
    */
    'connection' => [

        /*
        |----------------------------------------------------------------------------
        | Driver
        |----------------------------------------------------------------------------
        |
        | A MySQL driver that uses the pdo_mysql PDO extension.
        |
        */
        'driver' => env("DB_DRIVER"),

        /*
        |----------------------------------------------------------------------------
        | Host
        |----------------------------------------------------------------------------
        |
        | Hostname of the database to connect to.
        |
        */
        'host' => env('DB_HOSTNAME'),

        /*
        |----------------------------------------------------------------------------
        | User
        |----------------------------------------------------------------------------
        |
        | Username to use when connecting to the database.
        |
        */
        'user' => env('DB_USERNAME'),

        /*
        |----------------------------------------------------------------------------
        | Password
        |----------------------------------------------------------------------------
        |
        | Password to use when connecting to the database.
        |
        */
        'password' => env('DB_PASSWORD'),

        /*
        |----------------------------------------------------------------------------
        | Database name
        |----------------------------------------------------------------------------
        |
        | Name of the database/schema to connect to.
        |
        */
        'dbname' => env('DB_DATABASE'),

        /*
        |----------------------------------------------------------------------------
        | Port
        |----------------------------------------------------------------------------
        |
        | Port of the database to connect to.
        |
        */
        'port' => env('DB_PORT'),

        /*
        |----------------------------------------------------------------------------
        | Unix socket
        |----------------------------------------------------------------------------
        |
        | Name of the socket used to connect to the database.
        |
        */
        'unix_socket' => env('UNIX_SOCKET'),

        /*
        |----------------------------------------------------------------------------
        | Charset
        |----------------------------------------------------------------------------
        |
        | The charset used when connecting to the database.
        |
        */
        'charset' => env('CHARSET')
    ]
];