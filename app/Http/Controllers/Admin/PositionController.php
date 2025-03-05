<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Position;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    public function index()
    {
        return view('admin.position.index');
    }

    public function getData(Request $request)
    {
        $position = Position::all();

        return DataTables::of($position)
        ->addColumn('action', function($row) {
            $positionId = base64_encode($row->id);
            $positionDescription = base64_encode($row->position_description);

            $editButton = '<a href="javascript:void(0)" title="Edit" data-bs-toggle="modal" data-bs-target="#positionEditModal" data-position_id="'. $positionId .'" data-position_description="'. $positionDescription .'"  class="editButton mx-2"><i class="fa-solid fa-file-pen"></i></a>';
            $deleteButton = '<a href="javascript:void(0)" title="Hapus" class="text-danger" onClick="deletePosition(\'' . $row->id . '\')"><i class="fa-solid fa-trash"></i></a>';
            return $editButton . $deleteButton;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'positionDescription' => 'required|string|unique:positions,position_description|max:255',
        ]);

        $position = Position::create([
            'position_description' => $request->positionDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jabatan berhasil ditambahkan!',
            'data' => $position
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'newPositionDescription' => 'required|unique:positions,position_description|max:255'
        ];

        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($request, $validatedData) {
            $position = Position::where('id', $request->positionId)->firstOrFail();

            $position->update([
                'position_description' => $request->newPositionDescription,
                'updated_at' => Carbon::now(),
            ]);
        });

        $updatedPosition = Position::where('id', $request->positionId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data jabatan berhasil diubah!',
            'data' => $updatedPosition
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'positionId' => 'required',
        ]);

        $deletedPosition = Position::destroy($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data jabatan berhasil dihapus!',
            'data' => $deletedPosition
        ]);
    }
}
