<?php

namespace Tests\Feature;

use App\Employee;
use App\Schedule;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateScheduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_make_a_schedule()
    {
        $employee = factory(Employee::class)->create();
        $timeFrom = now()->toDateTimeString();
        $timeTo = now()->addHour()->toDateTimeString();

        $this->createSchedule([
            'employee_id' => $employee->id,
            'time_from' => $timeFrom,
            'time_to' => $timeTo
        ])->assertRedirect(route('schedules.index'));
    }

    /** @test */
    public function schedule_requires_a_valid_employee()
    {
        factory(Schedule::class, 2)->create();

        $this->createSchedule(['employee_id' => null])
             ->assertSessionHasErrors('employee_id');

        $this->createSchedule(['employee_id' => 999])
             ->assertSessionHasErrors('employee_id');
    }

    /** @test */
    public function schedule_requires_a_time_from()
    {
        $this->createSchedule(['time_from' => null])
             ->assertSessionHasErrors('time_from');
    }

    /** @test */
    public function schedule_requires_a_time_to()
    {
        $this->createSchedule(['time_to' => null])
             ->assertSessionHasErrors('time_to');
    }

    protected function createSchedule($overrides = [])
    {
        $schedule = factory(Schedule::class)->make($overrides);

        return $this->post(route('schedules.store'), $schedule->toArray());
    }
}
