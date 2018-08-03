<?php

namespace Tests\Unit;

use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_name()
    {
        $client = factory(Client::class)->create(['name' => 'John Doe']);

        $this->assertEquals('John Doe', $client->name);
    }

    /** @test */
    public function it_has_a_phone()
    {
        $client = factory(Client::class)->create(['phone' => '123456789']);

        $this->assertEquals('123456789', $client->phone);
    }

    /** @test */
    public function it_has_a_email()
    {
        $client = factory(Client::class)->create(['email' => 'johnDoe@gmail.com']);

        $this->assertEquals('johnDoe@gmail.com', $client->email);
    }
}
