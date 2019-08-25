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

namespace ProjectPlanner\Repositories;

use ProjectPlanner\Libraries\Base;
use ProjectPlanner\Model\TaskModel;

class TaskFrontendRepository extends RepositoryBase implements RepositoryInterface
{
    public function create()
    {

    }

    public function read()
    {
        $taskModel = new TaskModel;
        echo $taskModel->getId();
    }

    public function readAll()
    {
        $sql = '
        SELECT `tasks`.`id`,
        	`tasks`.`title`,
            `tasks`.`desc`,
            UNIX_TIMESTAMP(`tasks`.`begin`) as begin,
            UNIX_TIMESTAMP(`tasks`.`end`) as end,
            `priority`.`desc` as priority,
            `status`.`desc` as status,
            `tasks`.`contact_id`,
            `tasks`.`project_id`,
            UNIX_TIMESTAMP(`tasks`.`created_at`) as created_at,
            `tasks`.`updated_at`,
            `projects`.`title` as projectTitle
            FROM `tasks`
            LEFT JOIN `priority` ON `priority`.`id` = `tasks`.`priority`
            LEFT JOIN `status` ON `status`.`id` = `tasks`.`status`
            LEFT JOIN `projects` ON `projects`.`id` = `tasks`.`project_id`
                WHERE `tasks`.`status` != 4 
                    AND `tasks`.`status` != 5
        ';

        $stmt = $this->getDatabaseConnection()->query($sql);

        $taskList = [];
        while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $taskModel = new TaskModel;
            $taskModel->fetchAll($row);

            $taskList[] = $taskModel;
        }

        return $taskList;
    }

    public function update()
    {

    }

    public function delete()
    {

    }
 }

