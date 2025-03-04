<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Rank;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RankController extends Controller
{
    public function index()
    {
        return view('admin.rank.index');
    }

    public function getData(Request $request)
    {
        $rank = Rank::all();

        return DataTables::of($rank)
        ->addColumn('action', function($row) {
            $rankId = base64_encode($row->id);
            $rankName = base64_encode($row->rank_name);

            $editButton = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#rankEditModal" data-rank_id="'. $rankId .'" data-rank_name="'. $rankName .'"  class="editButton"><i class="fa-solid fa-file-pen"></i></a>';
            $deleteButton = '<a href="javascript:void(0)" onClick="deleteRank(\'' . $row->id . '\')"><i class="fa-solid fa-trash"></i></a>';
            return $editButton . $deleteButton;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rankName' => 'required|string|unique:ranks,rank_name|max:10',
        ]);

        $rank = Rank::create([
            'rank_name' => $request->rankName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Golongan berhasil ditambahkan!',
            'data' => $rank
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'newRankName' => 'required|unique:ranks,rank_name|max:10'
        ];

        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($request, $validatedData) {
            $rank = Rank::where('id', $request->rankId)->firstOrFail();

            $rank->update([
                'rank_name' => $request->newRankName,
                'updated_at' => Carbon::now(),
            ]);
        });

        $updatedRank = Rank::where('id', $request->rankId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data golongan berhasil diubah!',
            'data' => $updatedRank
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'rankId' => 'required',
        ]);

        $deletedRank = Rank::destroy($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil dihapus!',
            'data' => $deletedRank
        ]);
    }
}
