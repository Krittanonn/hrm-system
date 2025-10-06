<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{   

    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'position_id',
        'hire_date',
        'phone',
        'address',
        'user_id',
    ];

    public function department()
    {   
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salaries()
    {   
        return $this->hasMany(Salary::class); 
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }


}
