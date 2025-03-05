<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
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

class EmployeeController extends Controller
{
    public function index()
    {
        $ranks = Rank::all();
        $echelons = Echelon::all();
        $positions = Position::all();
        $workPlaces = WorkPlace::all();
        $religions = Religion::all();
        $workUnits = WorkUnit::all();

        return view('admin.employee.index', compact('ranks', 'echelons', 'positions', 'workPlaces', 'religions','workUnits'));
    }

    public function getData(Request $request)
    {
        $employee = Employee::with('rank', 'echelon', 'position', 'workPlace', 'religion', 'workUnit');

        if ($request->has('workUnit') && $request->workUnit != '') {
            $employee->where('work_unit_id', $request->workUnit);
        }

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
        ->addColumn('action', function($row) {
            $encodedData = [
                'employee_id' => base64_encode($row->employee_id),
                'name' => base64_encode($row->name),
                'birth_place' => base64_encode($row->birth_place),
                'address' => base64_encode($row->address),
                'birth_date' => base64_encode($row->birth_date),
                'gender' => base64_encode($row->gender),
                'echelon_id' => base64_encode($row->echelon_id),
                'position_id' => base64_encode($row->position_id),
                'work_place_id' => base64_encode($row->work_place_id),
                'religion_id' => base64_encode($row->religion_id),
                'work_unit_id' => base64_encode($row->work_unit_id),
                'phone_number' => base64_encode($row->phone_number),
                'npwp_number' => base64_encode($row->npwp_number),
                'img' => base64_encode($row->img),
            ];

            $editButton = '<a href="javascript:void(0)" title="Edit" data-bs-toggle="modal" data-bs-target="#employeeEditModal" class="editButton mx-2"';

            foreach ($encodedData as $key => $value) {
                $editButton .= ' data-' . $key . '="' . $value . '"';
            }

            $editButton .= '><i class="fa-solid fa-file-pen"></i></a>';
            $deleteButton = '<a href="javascript:void(0)" title="Hapus" class="text-danger" onClick="deleteEmployee(\'' . $row->employee_id . '\')"><i class="fa-solid fa-trash"></i></a>';
            return $editButton . $deleteButton;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employeeId' => 'required|unique:employees,employee_id|max:11',
            'name' => 'required|string|max:50',
            'birthPlace' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
            'birthDate' => 'required|date',
            'gender' => 'required|in:male,female',
            'religionId' => 'required',
            'rankId' => 'nullable|exists:ranks,id',
            'echelonId' => 'nullable|exists:echelons,id',
            'positionId' => 'nullable|exists:positions,id',
            'workPlaceId' => 'nullable|exists:work_places,id',
            'religionId' => 'required|exists:religions,id',
            'workUnitId' => 'nullable|exists:work_units,id',
            'phoneNumber' => 'nullable|string|max:15',
            'npwpNumber' => 'nullable|string|max:20',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imgName = null;

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $img->storeAs('public/profile', $imgName);
        }

        $employee = Employee::create([
            'employee_id' => $request->employeeId,
            'name' => $request->name,
            'birth_place' => $request->birthPlace,
            'birth_date' => $request->birthDate,
            'address' => $request->address,
            'gender' => $request->gender,
            'rank_id' => $request->rankId ? $request->rankId : null,
            'echelon_id' => $request->echelonId ? $request->echelonId : null,
            'position_id' => $request->positionId ? $request->positionId : null,
            'work_place_id' => $request->workPlaceId ? $request->workPlaceId : null,
            'religion_id' => $request->religionId,
            'work_unit_id' => $request->workUnitId ? $request->workUnitId : null,
            'phone_number' => $request->phoneNumber ? $request->phoneNumber : null,
            'npwp_number' => $request->npwpNumber ? $request->npwpNumber : null,
            'img' => $imgName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pegawai berhasil ditambahkan!',
            'data' => $employee
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'employeeId' => 'required|exists:employees,employee_id',
            'name' => 'required|string|max:50',
            'birthPlace' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
            'birthDate' => 'required|date',
            'gender' => 'required|in:male,female',
            'religionId' => 'required|exists:religions,id',
            'rankId' => 'nullable|exists:ranks,id',
            'echelonId' => 'nullable|exists:echelons,id',
            'positionId' => 'nullable|exists:positions,id',
            'workPlaceId' => 'nullable|exists:work_places,id',
            'workUnitId' => 'nullable|exists:work_units,id',
            'phoneNumber' => 'nullable|string|max:15',
            'npwpNumber' => 'nullable|string|max:20',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $imgName = null;

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $img->storeAs('public/profile', $imgName);
        }

        if ($request->employeeId !== $request->newEmployeeId) {
            $rules['newEmployeeId'] = 'required|unique:employees,employee_id|max:11';
        }

        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($request, $validatedData, $imgName) {
            $employee = Employee::where('employee_id', $request->employeeId)->firstOrFail();

            if ($request->employeeId !== $request->newEmployeeId) {
                $employee->update(['employee_id' => $request->newEmployeeId]);
            }

            $employee->update([
                'name' => $request->name,
                'birth_place' => $request->birthPlace,
                'birth_date' => $request->birthDate,
                'address' => $request->address,
                'gender' => $request->gender,
                'rank_id' => $request->rankId ?: null,
                'echelon_id' => $request->echelonId ?: null,
                'position_id' => $request->positionId ?: null,
                'work_place_id' => $request->workPlaceId ?: null,
                'religion_id' => $request->religionId,
                'work_unit_id' => $request->workUnitId ?: null,
                'phone_number' => $request->phoneNumber ?: null,
                'npwp_number' => $request->npwpNumber ?: null,
                'img' => $imgName,
                'updated_at' => Carbon::now(),
            ]);
        });

        $updatedEmployee = Employee::where('employee_id', $request->newEmployeeId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil diubah!',
            'data' => $updatedEmployee
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'employeeId' => 'required',
        ]);

        $deletedEmployee = Employee::destroy($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil dihapus!',
            'data' => $deletedEmployee
        ]);
    }
}
