<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\WorkUnit;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class WorkUnitController extends Controller
{
    public function index()
    {
        return view('admin.work-unit.index');
    }

    public function getData(Request $request)
    {
        $workUnit = WorkUnit::all();

        return DataTables::of($workUnit)
        ->addColumn('action', function($row) {
            $workUnitId = base64_encode($row->id);
            $workUnitName = base64_encode($row->work_unit_name);

            $editButton = '<a href="javascript:void(0)" title="Edit" data-bs-toggle="modal" data-bs-target="#workUnitEditModal" data-work_unit_id="'. $workUnitId .'" data-work_unit_name="'. $workUnitName .'"  class="editButton mx-2"><i class="fa-solid fa-file-pen"></i></a>';
            $deleteButton = '<a href="javascript:void(0)" title="Hapus" class="text-danger" onClick="deleteWorkUnit(\'' . $row->id . '\')"><i class="fa-solid fa-trash"></i></a>';
            return $editButton . $deleteButton;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'workUnitName' => 'required|string|unique:work_units,work_unit_name|max:100',
        ]);

        $workUnit = WorkUnit::create([
            'work_unit_name' => $request->workUnitName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Unit kerja berhasil ditambahkan!',
            'data' => $workUnit
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'newWorkUnitName' => 'required|unique:work_units,work_unit_name|max:100'
        ];

        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($request, $validatedData) {
            $workUnit = WorkUnit::where('id', $request->workUnitId)->firstOrFail();

            $workUnit->update([
                'work_unit_name' => $request->newWorkUnitName,
                'updated_at' => Carbon::now(),
            ]);
        });

        $updatedWorkUnit = WorkUnit::where('id', $request->workUnitId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data unit kerja berhasil diubah!',
            'data' => $updatedWorkUnit
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'workUnitId' => 'required',
        ]);

        $deletedWorkUnit = WorkUnit::destroy($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data unit kerja berhasil dihapus!',
            'data' => $deletedWorkUnit
        ]);
    }
}
