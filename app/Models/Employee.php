<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',    
        'name',
        'birth_place',
        'address',
        'birth_date',
        'gender',
        'rank_id',
        'echelon_id',
        'position_id',
        'work_place_id',
        'religion_id',
        'work_unit_id',
        'phone_number',
        'npwp_number'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function echelon()
    {
        return $this->belongsTo(Echelon::class, 'echelon_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function workPlace()
    {
        return $this->belongsTo(WorkPlace::class, 'work_place_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function workUnit()
    {
        return $this->belongsTo(WorkUnit::class, 'work_unit_id');
    }
}
