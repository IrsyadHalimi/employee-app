<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Echelon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class EchelonController extends Controller
{
    public function index()
    {
        return view('admin.echelon.index');
    }

    public function getData(Request $request)
    {
        $echelon = Echelon::all();

        return DataTables::of($echelon)
        ->addColumn('action', function($row) {
            $echelonId = base64_encode($row->id);
            $echelonName = base64_encode($row->echelon_name);

            $editButton = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#echelonEditModal" data-echelon_id="'. $echelonId .'" data-echelon_name="'. $echelonName .'"  class="editButton"><i class="fa-solid fa-file-pen"></i></a>';
            $deleteButton = '<a href="javascript:void(0)" onClick="deleteEchelon(\'' . $row->id . '\')"><i class="fa-solid fa-trash"></i></a>';
            return $editButton . $deleteButton;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'echelonName' => 'required|string|unique:echelons,echelon_name|max:10',
        ]);

        $echelon = Echelon::create([
            'echelon_name' => $request->echelonName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Eselon berhasil ditambahkan!',
            'data' => $echelon
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'newEchelonName' => 'required|unique:echelons,echelon_name|max:10'
        ];

        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($request, $validatedData) {
            $echelon = Echelon::where('id', $request->echelonId)->firstOrFail();

            $echelon->update([
                'echelon_name' => $request->newEchelonName,
                'updated_at' => Carbon::now(),
            ]);
        });

        $updatedEchelon = Echelon::where('id', $request->echelonId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data eselon berhasil diubah!',
            'data' => $updatedEchelon
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'echelonId' => 'required',
        ]);

        $deletedEchelon = Echelon::destroy($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data eselon berhasil dihapus!',
            'data' => $deletedEchelon
        ]);
    }
}
