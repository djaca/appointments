<?php

namespace Tests\Feature;

use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_add_a_new_client()
    {
        $this->createClient([
            'name' => 'John Doe',
            'phone' => '123',
            'email' => 'johnDoe@gmail.com'
        ])->assertRedirect(route('clients.index'));

        $this->assertDatabaseHas('clients', [
            'name' => 'John Doe',
            'phone' => '123',
            'email' => 'johnDoe@gmail.com'
        ]);
    }

    /** @test */
    public function client_requires_a_name()
    {
        $this->createClient(['name' => null])
             ->assertSessionHasErrors('name');
    }

    /** @test */
    public function client_email_must_be_valid_if_provided()
    {
        $this->createClient(['email' => 'email'])
             ->assertSessionHasErrors('email');

        $this->createClient(['email' => null])
             ->assertSessionHasNoErrors();
    }

    protected function createClient($overrides = [])
    {
        $client = factory(Client::class)->make($overrides);

        return $this->post(route('clients.store'), $client->toArray());
    }
}
