<?php

declare( strict_types = 1 );

use Entities\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    private Task $task;

    protected function setUp(): void
    {
        $this->task = new Task;
    }

    public function testIdIsEmptyByDefault()
    {
        return $this->assertEmpty($this->task->getId());
    }

    public function testTitleIsEmptyByDefault()
    {
        return $this->assertEmpty($this->task->getTitle());
    }

    public function testDesctiptionIsEmptyByDefault()
    {
        return $this->assertEmpty($this->task->getDescription());
    }

    public function testStatusIdIsEmptyByDefault()
    {
        return $this->assertEmpty($this->task->getStatusId());
    }

    public function testPriorityIdIsEmptyByDefault()
    {
        return $this->assertEmpty($this->task->getPriorityId());
    }

    public function testContactIdIsEmptyByDefault()
    {
        return $this->assertEmpty($this->task->getContactId());
    }

    public function testProjectIdIsEmptyByDefault()
    {
        return $this->assertEmpty($this->task->getProjectId());
    }
}