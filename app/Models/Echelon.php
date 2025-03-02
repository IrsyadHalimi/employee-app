<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echelon extends Model
{
    use HasFactory;

    protected $fillable = ['echelon_name'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'echelon_id');
    }
}
