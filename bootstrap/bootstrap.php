<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2020 Heinrich Schiller
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

use Dotenv\Dotenv;

error_reporting(-1);
ini_set('display_errors', '1');

/*
|----------------------------------------------------------------------------
| ROOT_DIR 
|----------------------------------------------------------------------------
|
| Absolute path to this application directory.
|
*/
if(!defined('ROOT_DIR')) {
    define('ROOT_DIR', __DIR__ . '/../');
}

/*
|----------------------------------------------------------------------------
| Loads environment variables from .env
|----------------------------------------------------------------------------
|
| You should never store sensitive credentials in your code.
| https://github.com/vlucas/phpdotenv
|
*/
$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();

/*
|----------------------------------------------------------------------------
| Routes with nikic/fast-route
|----------------------------------------------------------------------------
|
| This library provides a fast implementation of a regular expression based
| router.
|
*/
require __DIR__ . '/fast-route.bootstrap.php';