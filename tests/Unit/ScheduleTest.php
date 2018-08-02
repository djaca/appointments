<?php

namespace Tests\Unit;

use App\Employee;
use App\Schedule;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    protected $time;

    public function setUp()
    {
        parent::setUp();

        $this->time = now()->toDateTimeString();
    }

    /** @test */
    public function it_belongs_to_an_employee()
    {
        $schedule = factory(Schedule::class)->create();

        $this->assertInstanceOf(Employee::class, $schedule->employee);
    }

    /** @test */
    public function it_has_a_time_from()
    {
        $schedule = factory(Schedule::class)->create(['time_from' => $this->time]);

        $this->assertEquals($this->time, $schedule->time_from);
    }

    /** @test */
    public function it_has_a_time_to()
    {
        $schedule = factory(Schedule::class)->create(['time_to' => $this->time]);

        $this->assertEquals($this->time, $schedule->time_to);
    }
}
