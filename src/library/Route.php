<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2019 Heinrich Schiller
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

namespace ProjectPlanner\Library;

class Route
{
    private static $_routes = [];
    private static $_pathNotFound = '';
    private static $_methodNotAllowed = null;

    public static function add($expression, $function, $method = 'get')
    {
        array_push(self::$_routes, [
            'expression' => $expression,
            'function'   => $function,
            'method'     => $method
        ]);
    }

    public static function pathNotFound($function)
    {
        self::$_pathNotFound = $function;
    }

    public static function methodNotAllowed($function)
    {
        self::$_methodNotAllowed = $function;
    }

    public static function run($basepath = '/')
    {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

        $path = '/';
        if(isset($parsedUrl['path'])) {
            $path = $parsedUrl['path'];
        }

        $currentMethod = $_SERVER['REQUEST_METHOD'];

        $pathMatchFound = false;
        $routeMatchFound = false;

        foreach(self::$_routes as $route) {

            // add basepath to matching string
            if($basepath != '' && $basepath != '/') {
                $route['expression'] = "($basepath){$route['expression']}";
            }

            // add 'find string start' automatically
            $route['expression'] = "^{$route['expression']}";

            // add 'find string end' automatically
            $route['expression'] = "{$route['expression']}$";

            if(preg_match("#{$route['expression']}#", $path, $matches)) {

                $pathMatchFound = true;

                if(strtolower($currentMethod) == strtolower($route['method'])) {
                    array_shift($matches);

                    if($basepath != '' && $basepath != '/') {
                        array_shift($matches);
                    }

                    call_user_func_array($route['function'], $matches);

                    $routeMatchFound = true;

                    // do not use other routes
                    break;
                }
            }
        }

        if( !$routeMatchFound ) {

            if($pathMatchFound) {
                header("HTTP/1.0 405 Method Not Allowed");

                if(self::$_methodNotAllowed) {
                    call_user_func_array(self::$_methodNotAllowed, [$path, $currentMethod]);
                }
            } else {
                header("HTTP/1.0 404 Not Found");

                if(self::$_pathNotFound) {
                    call_user_func_array(self::$_pathNotFound, [$path]);
                }
            }
        }
    }
}