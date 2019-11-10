<?php declare(strict_types = 1);

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

class Application
{
    /**
     * Index of controller-method
     * 
     * @var int
     */
    const REQUEST_CONTROLLER = 0;

    /**
     * Index of action-method
     * 
     * @var int
     */
    const REQUEST_ACTION     = 1;

    /**
     * Index of params-method
     * 
     * @var int
     */
    const REQUEST_PARAMS     = 2;

    /**
     * Controller
     * 
     * @var string
     */
    private $_controller = '';

    /**
     * Action
     * 
     * @var string
     */
    private $_action     = '';

    /**
     * Params
     * 
     * @var array
     */
    private $_params     = [];

    private $_config     = [];

    public function __construct()
    {
        $this->_loadConfig();
        $this->_parseRequest();
    }

    private function _parseRequest()
    {
        $request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $reqItems = explode('/', $request, 3);

        $controller = !empty($reqItems[self::REQUEST_CONTROLLER]) 
            ? $reqItems[self::REQUEST_CONTROLLER] 
            : $this->_config['default_controller'];

        $this->_setController($controller);

        $action = !empty($reqItems[self::REQUEST_ACTION]) 
            ? $reqItems[self::REQUEST_ACTION] 
            : $this->_config['default_action'];

        $this->_setAction($action);

        $params = !empty($reqItems[self::REQUEST_PARAMS]) 
            ? $reqItems[self::REQUEST_PARAMS] 
            : [];

        if(isset($params)) {
            $this->_setParams($params);
        }
    }

    private function _setController(string $ctrl = '')
    {
        if( !empty($ctrl) && !is_numeric($ctrl)) {
            $ctrl = htmlspecialchars($ctrl);
            $controller = trim($ctrl);
        }

        $format = "ProjectPlanner\Controller\%sController";
        $ctrl = sprintf($format, ucfirst(strtolower($controller)));

        if(!class_exists($ctrl)) {
            throw new \InvalidArgumentException("Unknown controller: $ctrl");
        }

        $this->_controller = $ctrl;
    }

    private function _setAction(string $action)
    {
        if( !empty($action) && !is_numeric($action)) {
            $action = htmlspecialchars($action);
            $action = trim($action);
        }

        $action = sprintf("%sAction", strtolower($action));
        $reflection = new \ReflectionClass($this->_controller);

        if(!$reflection->hasMethod($action)) {
            throw new \InvalidArgumentException("Unknown action: $action");
        }

        $this->_action = $action;
    }

    private function _setParams(array $params): array
    {
        return [];
    }

    private function _loadConfig()
    {
        $configFile = ROOT_DIR . 'src/configs/settings.config.php';

        if( file_exists($configFile) ) {
            return $this->_config = include $configFile;
        }

        throw \Exception("Config file not found.");
    }

    public function run()
    {
        $ctrlObj = new $this->_controller;
        echo $ctrlObj->{$this->_action}();
    }
}
