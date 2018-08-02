<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\CreateScheduleRequest;
use App\Schedule;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
}
