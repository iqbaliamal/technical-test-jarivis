<?php

namespace App\Http\Controllers;

use App\Models\KegiatanInti;
use Illuminate\Http\Request;

class KegiatanIntiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data = KegiatanInti::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all kegiatan inti.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all kegiatan inti.',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rpp_id' => 'required',
            'pertemuan_id' => 'required',
            'description' => 'required',
        ]);

        $data = KegiatanInti::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new kegiatan inti.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new kegiatan inti.',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $id)
    {
        $data = KegiatanInti::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kegiatan inti.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved kegiatan inti.',
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'rpp_id' => 'required',
            'pertemuan_id' => 'required',
            'description' => 'required',
        ]);

        $data = KegiatanInti::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kegiatan inti.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated kegiatan inti.',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = KegiatanInti::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kegiatan inti.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted kegiatan inti.',
            'data' => $data
        ], 200);
    }
}
