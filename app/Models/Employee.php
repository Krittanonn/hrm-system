<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{   
    /* 
    whitelist for mass assignment 
    ex. input first_name, age  age find not fillable so will be ignored and not saved to db 
    */
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
        // Fk Employee belongsto Department
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
        // Fk Employee belongsto Position
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        // Fk Employee belongsto User
    }

    public function salaries()
    {   
        return $this->hasMany(Salary::class); 
        // PK Employee has many to Salaries because can use to track salary history
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }


}
