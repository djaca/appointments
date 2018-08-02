<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['time_from', 'time_to'];

    protected $with = ['employee'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
