<?php

declare(strict_types = 1);

use Entities\Note;
use PHPUnit\Framework\TestCase;

class NoteTest extends TestCase
{
    private Note $note;

    protected function setUp(): void
    {
        $this->note = new Note;
    }

    public function testTitleIsEmptyByDefault()
    {
        $this->assertEmpty($this->note->getTitle());
    }

    public function testNoteHasTitle()
    {
        $this->note->setTitle('Title');

        $this->assertEquals('Title', $this->note->getTitle());
    }

    public function testTitleDoesNotStartOrEndWithAnWhitespace()
    {
        $this->note->setTitle(' Title ');

        $this->assertEquals('Title', $this->note->getTitle());
    }

    public function testDescriptionIsEmptyByDefault()
    {
        $this->assertEmpty($this->note->getDescription());
    }

    public function testNoteHasDescription()
    {
        $this->note->setDescription('Description');

        $this->assertEquals('Description', $this->note->getDescription());
    }

    public function testContactIdIsEmptyByDefault()
    {
        $this->assertEmpty($this->note->getContactId());
    }

    public function testReturnContactId()
    {
        $this->note->setContactId(1);

        $this->assertEquals( 1, $this->note->getContactId() );
    }

    public function testReturnProjectIdAsInteger()
    {
        $this->note->setProjectId(2);

        $this->assertEquals( 2, $this->note->getProjectId() );
    }

    public function testTaskIdAsInteger()
    {
        $this->note->setTaskId(3);

        $this->assertEquals( 3, $this->note->getTaskId() );
    }
}