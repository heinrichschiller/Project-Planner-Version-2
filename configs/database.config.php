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

return [
    
    /*
    |----------------------------------------------------------------------------
    | Type of the Database
    |----------------------------------------------------------------------------
    |
    | The type of the supported database. ProjectPlanner uses currently only the
    | mysql/mariadb database.
    |
    |
    */
    'type' => 'mysql',

    /*
    |----------------------------------------------------------------------------
    | Port of mysql/mariadb database
    |----------------------------------------------------------------------------
    |
    | Default port of mysql/mariadb database is 3306.
    |
    */
    'port' => 3306,

    /*
    |----------------------------------------------------------------------------
    | Charset of mysql/mariadb database
    |----------------------------------------------------------------------------
    |
    | 
    |
    */
    'charset' => 'utf8mb4',

    /*
    |----------------------------------------------------------------------------
    | IP-Address of the Host-Server
    |----------------------------------------------------------------------------
    |
    | Host-Address for the database. When you want to use the FQN, use the
    | hostname-key instead.
    |
    */
    'host' => '',

    /*
    |----------------------------------------------------------------------------
    | Hostname
    |----------------------------------------------------------------------------
    |
    | The FQN of hostname like https://www.example.com. You can use an IP-Address
    | instead. See above, IP-Address-Configuration.
    |
    */
    'hostname' => '',

    /*
    |----------------------------------------------------------------------------
    | Username of the database
    |----------------------------------------------------------------------------
    |
    | The administrator name of your database, who has full permissions to read,
    | write etc. in this database.
    |
    */
    'username' => '',

    /*
    |----------------------------------------------------------------------------
    | Password of the database
    |----------------------------------------------------------------------------
    |
    | Password of the database you want to use.
    |
    */
    'password' => '',

    /*
    |----------------------------------------------------------------------------
    | Name of the database
    |----------------------------------------------------------------------------
    |
    | The fullname of the database that you want to use.
    |
    */
    'database' => '',

    /*
    |----------------------------------------------------------------------------
    | PDO options
    |----------------------------------------------------------------------------
    |
    | Sets an attribute on the database handle. See:
    | https://www.php.net/manual/de/pdo.setattribute.php
    |
    */
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]
];