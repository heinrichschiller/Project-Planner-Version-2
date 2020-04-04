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

class Database
{
    private string $_hostname = '';
    private string $_username = '';
    private string $_password = '';
    private string $_database = '';

    private $_pdo   = null;
    private $_stmt  = null;
    private $_error = '';

    public function __construct()
    {
        $this->_loadConfig();
        $this->_init();
    }

    private function _init()
    {
        $dsn = 'mysql:host=' . self::_getHostname() . ';dbname=' . self::_getDatabase();
        $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
        
        try {
            $this->_pdo = new \PDO($dsn, $this->_getUsername(), $this->_getPassword(), $options);
        } catch (PDOException $e) {
            $this->_setError($e->getMessage());
            echo $this->_getError();
        }
    }

    private function _loadConfig()
    {
        $config = include ROOT_DIR . 'src/configs/database.config.php';

        $this->_setHostname($config['hostname']);
        $this->_setUsername($config['username']);
        $this->_setPassword($config['password']);
        $this->_setDatabase($config['database']);
    }

    private function _getHostname(): string
    {
        return $this->_hostname;
    }

    private function _setHostname(string $hostname)
    {
        $this->_hostname = $hostname;
    }

    private function _getUsername(): string 
    {
        return $this->_username;
    }

    private function _setUsername(string $username)
    {
        $this->_username = $username;
    }

    private function _getPassword(): string 
    {
        return $this->_password;
    }

    private function _setPassword(string $password)
    {
        $this->_password = $password;
    }

    private function _getDatabase(): string
    {
        return $this->_database;
    }

    private function _setDatabase(string $database)
    {
        $this->_database = $database;
    }

    private function _getError(): string 
    {
        return $this->_error;
    }

    private function _setError(string $error)
    {
        $this->_error = $error;
    }

    public function query(string $query)
    {
        return $this->_pdo->query($query);
    }

    public function prepare(string $query)
    {
        $this->_stmt = $this->_pdo->prepare($query);
    }

    public function bindValue()
    {

    }

    public function bindParam()
    {

    }

    public function execute(): PDOStatement
    {
        return $this->_stmt->execute();
    }
}