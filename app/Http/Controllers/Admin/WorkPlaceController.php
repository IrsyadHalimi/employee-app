<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\WorkPlace;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class WorkPlaceController extends Controller
{
    public function index()
    {
        return view('admin.work-place.index');
    }

    public function getData(Request $request)
    {
        $workPlace = WorkPlace::all();

        return DataTables::of($workPlace)
        ->addColumn('action', function($row) {
            $workPlaceId = base64_encode($row->id);
            $workPlaceName = base64_encode($row->work_place_name);

            $editButton = '<a href="javascript:void(0)" title="Edit" data-bs-toggle="modal" data-bs-target="#workPlaceEditModal" data-work_place_id="'. $workPlaceId .'" data-work_place_name="'. $workPlaceName .'"  class="editButton"><i class="fa-solid fa-file-pen"></i></a>';
            $deleteButton = '<a href="javascript:void(0)" title="Hapus" onClick="deleteWorkPlace(\'' . $row->id . '\')"><i class="fa-solid fa-trash"></i></a>';
            return $editButton . $deleteButton;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'workPlaceName' => 'required|string|unique:work_places,work_place_name|max:100',
        ]);

        $workPlace = WorkPlace::create([
            'work_place_name' => $request->workPlaceName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tempat tugas berhasil ditambahkan!',
            'data' => $workPlace
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'newWorkPlaceName' => 'required|unique:work_places,work_place_name|max:100'
        ];

        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($request, $validatedData) {
            $workPlace = WorkPlace::where('id', $request->workPlaceId)->firstOrFail();

            $workPlace->update([
                'work_place_name' => $request->newWorkPlaceName,
                'updated_at' => Carbon::now(),
            ]);
        });

        $updatedWorkPlace = WorkPlace::where('id', $request->workPlaceId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data tempat tugas berhasil diubah!',
            'data' => $updatedWorkPlace
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'workPlaceId' => 'required',
        ]);

        $deletedWorkPlace = WorkPlace::destroy($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data tempat tugas berhasil dihapus!',
            'data' => $deletedWorkPlace
        ]);
    }
}
