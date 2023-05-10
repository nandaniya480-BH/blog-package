<?php

namespace Nandaniya480\Blog\Tests;

use Orchestra\Testbench\TestCase;

class BlogTest extends TestCase
{
    /** @test */
    public function it_can_access_the_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
