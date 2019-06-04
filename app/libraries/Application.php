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

namespace ProjectPlanner\Libraries;

use ProjectPlanner\Controller;

class Application
{
    private $_controller = '';
    private $_action     = '';
    private $_params     = [];

    public function __construct()
    {
        $this->_parseRequest();
    }

    private function _parseRequest()
    {
        $request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $reqItems = explode('/', $request, 3);

        $controller = !empty($reqItems[0]) ? $reqItems['0'] : 'dashboard';
        $this->_setController($controller);

        $action     = !empty($reqItems[1]) ? $reqItems['1'] : 'index';
        $this->_setAction($action);

        $params     = !empty($reqItems[2]) ? $reqItems['2'] : [];

        if(isset($params)) {
            $this->_setParams($params);
        }
    }

    private function _setController(string $ctrl)
    {
        $format = "ProjectPlanner\Controller\%sController";
        $ctrl = sprintf($format, ucfirst(strtolower($ctrl)));

        if(!class_exists($ctrl)) {
            throw new \InvalidArgumentException("Unknown controller: $ctrl");
        }

        $this->_controller = $ctrl;
    }

    private function _setAction(string $action)
    {
        $action = sprintf("%sAction", strtolower($action));
        $reflection = new \ReflectionClass($this->_controller);

        if(!$reflection->hasMethod($action)) {
            throw new \InvalidArgumentException("Unknown action: $action");
        }

        $this->_action = $action;
    }

    private function _setParams(array $params)
    {

    }

    public function run()
    {
        $ctrlObj = new $this->_controller;
        echo $ctrlObj->{$this->_action}();
    }
}
