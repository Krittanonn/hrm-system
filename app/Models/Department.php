<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // ระบุ field ที่อนุญาตให้กรอกได้จาก form
    protected $fillable = ['name'];

    // ความสัมพันธ์: 1 แผนก มีหลายพนักงาน
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
