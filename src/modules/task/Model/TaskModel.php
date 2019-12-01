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

namespace ProjectPlanner\Model;

use ProjectPlanner\Entities\Task;
use ProjectPlanner\Library\Model;
use ProjectPlanner\Util\Collection;

class TaskModel extends Model implements ModelInterface 
{
    public function create() {}

    public function read() {}

    public function update() {}

    public function delete() {}

    public function readAll()
    {
        $sql = <<<SQL
        SELECT `tasks`.`id`,
        	`tasks`.`title`,
            `tasks`.`desc`,
            UNIX_TIMESTAMP(`tasks`.`begin_at`) as begin_at,
            UNIX_TIMESTAMP(`tasks`.`end_at`) as end_at,
            `priority`.`desc` as priority,
            `status`.`desc` as status,
            `contacts`.`name` as contact,
            `tasks`.`project_id`,
            UNIX_TIMESTAMP(`tasks`.`created_at`) as created_at,
            `tasks`.`updated_at`,
            `projects`.`title` as project
            FROM `tasks`
            LEFT JOIN `priority` ON `priority`.`id` = `tasks`.`priority_id`
            LEFT JOIN `status` ON `status`.`id` = `tasks`.`status_id`
            LEFT JOIN `projects` ON `projects`.`id` = `tasks`.`project_id`
            LEFT JOIN `contacts`ON `contacts`.`id`= `tasks`.`contact_id`
            WHERE `tasks`.`status_id` != 4 
                AND `tasks`.`status_id` != 5
        SQL;

        $stmt = $this->getDatabaseConnection()->query($sql);

        $tasks = new Collection;
        while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $task = new Task;

            $task->setId( (int) $row->id );
            $task->setTitle( $row->title );
            $task->setDesc( $row->desc );
            $task->setBeginAt( $row->begin_at );
            $task->setEndAt( $row->end_at );
            $task->setPriority( $row->priority );
            $task->setStatus( $row->status );
            $task->setContact( $row->contact );
            $task->setProjectId( (int) $row->project_id );
            $task->setCreatedAt( $row->created_at );
            $task->setUpdatedAt( $row->updated_at );
            $task->setProject( $row->project );

            $tasks->add($task);
        }

        return $tasks;
    }
}