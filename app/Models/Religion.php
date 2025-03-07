<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;

    protected $fillable = ['religion_name'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'religion_id');
    }
}
