<?php

namespace App;

use Calendar;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['time_from', 'time_to'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['employee'];

    /**
     * Schedules belongs to an Employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Format schedules for Calendar.
     *
     * @return \Calendar
     */
    public static function getForCalendar()
    {
        $dayClick = "function(date, jsEvent, view) {
            window.location.href='" . route('schedules.create') . "?day=' + date.format()
        }";

        return Calendar::addEvents(self::parseEvents())
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
    }

    /**
     * Get schedules from database and map with Calendar.
     *
     * @return array
     */
    private static function parseEvents()
    {
        $colors = assignColor(Employee::pluck('first_name'));

        return self::get(['id', 'employee_id', 'time_from', 'time_to'])
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
}
