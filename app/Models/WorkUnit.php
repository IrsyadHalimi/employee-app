<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkUnit extends Model
{
    use HasFactory;

    protected $fillable = ['work_unit_name'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'work_unit_id');
    }
}
