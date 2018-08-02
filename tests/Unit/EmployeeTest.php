<?php

namespace Tests\Unit;

use App\Employee;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_all_fields()
    {
        $employee = factory(Employee::class)->create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        self::assertEquals('John', $employee->first_name);
        self::assertEquals('Doe', $employee->last_name);
    }
}
