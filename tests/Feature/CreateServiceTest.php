<?php

namespace Tests\Feature;

use App\Service;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_add_a_new_service()
    {
        $this->createService([
            'name' => 'lorem',
            'duration' => 10,
            'price' => 50
        ])->assertRedirect(route('services.index'));

        $this->assertDatabaseHas('services', [
            'name' => 'lorem',
            'duration' => 10,
            'price' => 50
        ]);
    }

    /** @test */
    public function service_requires_a_name_to_be_unique()
    {
        $this->createService(['name' => null])
             ->assertSessionHasErrors('name');

        $service = factory(Service::class)->create();
        $this->createService(['name' => $service->name])
             ->assertSessionHasErrors('name');
    }

    /** @test */
    public function service_requires_a_duration()
    {
        $this->createService(['duration' => null])
             ->assertSessionHasErrors('duration');
    }

    /** @test */
    public function service_requires_a_price()
    {
        $this->createService(['price' => null])
             ->assertSessionHasErrors('price');
    }

    protected function createService($overrides = [])
    {
        $service = factory(Service::class)->make($overrides);

        return $this->post(route('services.store'), $service->toArray());
    }
}
