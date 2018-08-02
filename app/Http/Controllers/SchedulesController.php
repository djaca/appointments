<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\CreateScheduleRequest;
use App\Schedule;
use Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dayClick = "function(date, jsEvent, view) {
            window.location.href='" . route('schedules.create') . "?day=' + date.format()
        }";


        $calendar = Calendar::addEvents($this->parseEvents())
                            ->setOptions([
                                'firstDay' => 1,
                                'header' => [
                                    'center' => '',
                                    'right' => 'today prev,next'
                                ],
                                'timeFormat' => 'H(:mm)',
                                'displayEventEnd' => true,
                            ])
                            ->setCallbacks([
                                'dayClick' => $dayClick,
                            ]);

        return view('schedules.index', compact('calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();

        return view('schedules.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateScheduleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateScheduleRequest $request)
    {
        Employee::find($request->employee_id)
                ->addSchedule($request->only(['time_from', 'time_to']));

        return redirect()->route('schedules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule $schedule
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule $schedule
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Schedule            $schedule
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule $schedule
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    /**
     * Get schedules from database and map with Calendar
     *
     * @return array
     */
    public function parseEvents()
    {
        $colors = $this->assignColorTo(Employee::pluck('first_name'));

        return Schedule::get(['id', 'employee_id', 'time_from', 'time_to'])
                       ->map(function ($schedule) use ($colors) {
                           return Calendar::event(
                               $schedule->employee->first_name,
                               false, //full day event?
                               $schedule->time_from, //start time
                               $schedule->time_to, //end time
                               $schedule->id, //optionally, event ID,
                               [
                                   'color' => $colors[$schedule->employee->first_name],
                               ]

                           );
                       })
                       ->toArray();
    }

    /**
     * @param $employees
     *
     * @return mixed
     */
    private function assignColorTo(Collection $employees)
    {
        $employeesCount = $employees->count();
        $colors = collect(['red', 'blue', 'pink', 'maroon', 'grey'])
            ->take($employeesCount)
            ->toArray();

        return $employees->combine($colors);
    }
}
