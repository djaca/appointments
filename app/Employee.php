<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function addSchedule($data)
    {
        return $this->schedules()->create($data);
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
