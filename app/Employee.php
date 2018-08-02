<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
