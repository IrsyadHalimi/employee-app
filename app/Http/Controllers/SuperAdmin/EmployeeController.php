<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\WorkUnit;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index() 
    {
        $workUnits = WorkUnit::all();
        return view('superadmin.employee.index', compact('workUnits'));
    }

    public function getData(Request $request)
    {
        $query = Employee::query();
        
        if ($request->has('workUnit') && $request->workUnit != '') {
            $query->where('work_unit_id', $request->workUnit);
        }

        return DataTables::of($query)
        ->make(true);
    }

    public function store(Request $request)
    {
        $query = Employee::create([
            'employee_id' => $request->employeeId,
            'name' => $request->name,
            'birth_place' => $request->birthPlace,
            'birth_date' => $request->birthDate,
            'address' => $request->address,
            'gender' => $request->gender,
            'rank_id' => $request->rankId,
            'echelon_id' => $request->echelonId,
            'position_id' => $request->positionId,
            'work_place_id' => $request->workPlaceId,
            'religion_id' => $request->religionId,
            'work_unit_id' => $request->workUnitId,
            'phone_number' => $request->phoneNumber,
            'npwp_number' => $request->npwpNumber,
        ]);
    }
}
