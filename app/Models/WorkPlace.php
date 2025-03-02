<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPlace extends Model
{
    use HasFactory;

    protected $fillable = ['work_place_name'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'work_place_id');
    }
}
