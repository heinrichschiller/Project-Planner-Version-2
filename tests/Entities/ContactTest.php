<?php

declare(strict_types = 1);

use Entities\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    private Contact $contact;

    public function setUp(): void
    {
        $this->contact = new Contact;
    }

    public function testDisplayNameIsEmptyByDefault()
    {
        $this->assertEmpty($this->contact->getDisplayName());
    }

    public function testContactHasDisplayName()
    {
        $this->contact->setDisplayName('Bruce Wayne');

        $this->assertEquals('Bruce Wayne', $this->contact->getDisplayName());
    }

    public function testDisplayNameDoesNotStartOrEndWithAnWhitespace()
    {
        $this->contact->setDisplayName(' Bruce Wayne ');

        $this->assertEquals('Bruce Wayne', $this->contact->getDisplayName());
    }

    public function testDisplayNameDoesStartWithUppercases()
    {
        $this->contact->setDisplayName('bruce wayne');

        $this->assertEquals('Bruce Wayne', $this->contact->getDisplayName());
    }
}