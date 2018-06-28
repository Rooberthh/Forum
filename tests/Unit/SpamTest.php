<?php

namespace Tests\Feature;

use App\Inspections\Spam;
use Tests\TestCase;

class SpamTest extends TestCase
{
    /** @test */
    public function it_checks_for_invalid_keywords()
    {

        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent Reply here'));

        $this->expectException('Exception');

        $spam->detect('yahoo customer support');
    }

    /** @test */
    public function it_checks_for_key_held_down()
    {
        // invalid keywords
        // key held down

        $spam = new Spam();

        $this->expectException('Exception');
        $spam->detect('Hello world aaaaaa');
    }

}
