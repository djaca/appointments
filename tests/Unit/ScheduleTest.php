<?php

namespace Tests\Unit;

use App\Employee;
use App\Schedule;
use MaddHatter\LaravelFullcalendar\Calendar;
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

    /** @test */
    public function it_can_create_a_schedule()
    {
        $employee = factory(Employee::class)->create();
        $timeFrom = now()->toDateTimeString();
        $timeTo = now()->addHours(8)->toDateTimeString();

        $schedule = $employee->addSchedule([
            'time_from' => $timeFrom,
            'time_to' => $timeTo
        ]);


        $this->assertEquals($employee->first_name, $schedule->employee->first_name);
        $this->assertEquals($timeFrom, $schedule->time_from);
        $this->assertEquals($timeTo, $schedule->time_to);
    }

    /** @test */
    public function it_can_get_schedules_and_format_it_for_calendar_view()
    {
        factory(Schedule::class, 4)->create();

        $schedules = Schedule::getForCalendar();

        $this->assertInstanceOf(Calendar::class, $schedules);
    }
}
