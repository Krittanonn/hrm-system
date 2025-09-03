<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

        protected $fillable = [
            'name',
            'email',
            'password',
            'role_id',
        ];

    // hidden data
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // cast data type
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
        // Fk User belongsto Role
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
        // PK User has one to Employee
    }
}
