<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Mata Pelajaran"},
     *   path="/api/mata-pelajaran/list",
     *   summary="Retrieve all mata-pelajarans",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = MataPelajaran::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all mata pelajaran.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all mata pelajaran.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Mata Pelajaran"},
     *   path="/api/mata-pelajaran/store",
     *   summary="Create a new mata-pelajaran",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"jenis_mata_pelajaran_id", "sekolah_id", "name", "singkatan", "description", "status"},
     *       @OA\Property(property="sekolah_id", type="string"),
     *       @OA\Property(property="jenis_mata_pelajaran_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="singkatan", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="sekolah_id", type="string"),
     *       @OA\Property(property="jenis_mata_pelajaran_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="singkatan", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean"),
     *       @OA\Property(property="created_at", type="string"),
     *       @OA\Property(property="updated_at", type="string"),
     *       @OA\Property(property="deleted_at", type="string")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     *   )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sekolah_id' => 'required',
            'jenis_mata_pelajaran_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $data = MataPelajaran::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new mata pelajaran.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new mata pelajaran.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Mata Pelajaran"},
     *   path="/api/mata-pelajaran/detail/{id}",
     *   summary="Retrieve a mata-pelajaran",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="mata-pelajaran ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function detail(string $id)
    {
        $data = MataPelajaran::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve mata pelajaran.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved mata pelajaran.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Mata Pelajaran"},
     *   path="/api/mata-pelajaran/update/{id}",
     *   summary="Update a mata-pelajaran",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="mata-pelajaran ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"jenis_mata_pelajaran_id", "sekolah_id", "name", "singkatan", "description", "status"},
     *       @OA\Property(property="sekolah_id", type="string"),
     *       @OA\Property(property="jenis_mata_pelajaran_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="singkatan", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean")
     *    )
     *  ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *       @OA\JsonContent(
     *         type="object",
     *       @OA\Property(property="sekolah_id", type="string"),
     *       @OA\Property(property="jenis_mata_pelajaran_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="singkatan", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean"),
     *       @OA\Property(property="created_at", type="string"),
     *       @OA\Property(property="updated_at", type="string"),
     *       @OA\Property(property="deleted_at", type="string")
     *     )
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     *
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'sekolah_id' => 'required',
            'jenis_mata_pelajaran_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $data = MataPelajaran::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve mata pelajaran.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated mata pelajaran.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Mata Pelajaran"},
     *   path="/api/mata-pelajaran/delete/{id}",
     *   summary="Delete a mata-pelajaran",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="mata-pelajaran ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy(string $id)
    {
        $data = MataPelajaran::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Mata pelajaran not found.',
                'data' => ''
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted mata pelajaran.',
            'data' => $data
        ], 200);
    }
}
