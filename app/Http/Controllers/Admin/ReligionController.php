<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Religion;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ReligionController extends Controller
{
    public function index()
    {
        return view('admin.religion.index');
    }

    public function getData(Request $request)
    {
        $religion = Religion::all();

        return DataTables::of($religion)
        ->addColumn('action', function($row) {
            $religionId = base64_encode($row->id);
            $religionName = base64_encode($row->religion_name);

            $editButton = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#religionEditModal" data-religion_id="'. $religionId .'" data-religion_name="'. $religionName .'"  class="editButton"><i class="fa-solid fa-file-pen"></i></a>';
            $deleteButton = '<a href="javascript:void(0)" onClick="deleteReligion(\'' . $row->id . '\')"><i class="fa-solid fa-trash"></i></a>';
            return $editButton . $deleteButton;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'religionName' => 'required|string|unique:religions,religion_name|max:50',
        ]);

        $religion = Religion::create([
            'religion_name' => $request->religionName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Agama berhasil ditambahkan!',
            'data' => $religion
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'newReligionName' => 'required|unique:religions,religion_name|max:50'
        ];

        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($request, $validatedData) {
            $religion = Religion::where('id', $request->religionId)->firstOrFail();

            $religion->update([
                'religion_name' => $request->newReligionName,
                'updated_at' => Carbon::now(),
            ]);
        });

        $updatedReligion = Religion::where('id', $request->religionId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data Agama berhasil diubah!',
            'data' => $updatedReligion
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'religionId' => 'required',
        ]);

        $deletedReligion = Religion::destroy($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data Agama berhasil dihapus!',
            'data' => $deletedReligion
        ]);
    }
}
