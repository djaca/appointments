<?php

namespace Tests\Feature;

use App\Employee;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateEmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_add_new_employee()
    {
        $this->createEmployee([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ])->assertRedirect(route('employees.index'));

        $this->assertDatabaseHas('employees', [
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);
    }

    /** @test */
    public function schedule_requires_a_first_name()
    {
        $this->createEmployee(['first_name' => null])
             ->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function schedule_requires_a_last_name()
    {
        $this->createEmployee(['last_name' => null])
             ->assertSessionHasErrors('last_name');
    }

    protected function createEmployee($overrides = [])
    {
        $employee = factory(Employee::class)->make($overrides);

        return $this->post(route('employees.store'), $employee->toArray());
    }
}
