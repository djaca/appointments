<?php

namespace Tests\Feature;

use App\Service;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_name()
    {
        $service = factory(Service::class)->create(['name' => 'service']);

        $this->assertEquals('service', $service->name);
    }

    /** @test */
    public function it_has_a_duration()
    {
        $service = factory(Service::class)->create(['duration' => 25]);

        $this->assertEquals(25, $service->duration);
    }

    /** @test */
    public function it_has_a_price()
    {
        $service = factory(Service::class)->create(['price' => 300]);

        $this->assertEquals(300, $service->price);
    }
}
