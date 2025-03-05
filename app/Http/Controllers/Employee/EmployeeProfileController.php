<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Rank;
use App\Models\Echelon;
use App\Models\Position;
use App\Models\WorkPlace;
use App\Models\Religion;
use App\Models\WorkUnit;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class EmployeeProfileController extends Controller
{

    public function index()
    {
        return view('employee.profile.index');
    }

    public function getData(Request $request)
    {
        $employeeId = User::with('employee')->find(Auth::id())->employee->employee_id;
        $employee = Employee::with('rank', 'echelon', 'position', 'workPlace', 'religion', 'workUnit')->where('employee_id', $employeeId);

        return DataTables::of($employee)
        ->editColumn('gender', function ($row) {
            return $row->gender === 'male' ? 'L' : 'P';
        })
        ->editColumn('rank.rank_name', function ($row) {
            return optional($row->Rank)->rank_name ?? '-';
        })
        ->editColumn('echelon.echelon_name', function ($row) {
            return optional($row->Echelon)->echelon_name ?? '-';
        })
        ->editColumn('position.position_description', function ($row) {
            return optional($row->Position)->position_description ?? '-';
        })
        ->editColumn('workPlace.work_place_name', function ($row) {
            return optional($row->workPlace)->work_place_name ?? '-';
        })
        ->editColumn('workUnit.work_unit_name', function ($row) {
            return optional($row->workUnit)->work_unit_name ?? '-';
        })
        ->make(true);
    }
}
