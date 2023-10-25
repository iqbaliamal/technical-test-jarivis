<?php

namespace App\Http\Controllers;

use App\Models\JenisMataPelajaran;
use Illuminate\Http\Request;

class JenisMataPelajaranController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Jenis Mata Pelajaran"},
     *   path="/api/jenis-mata-pelajaran/list",
     *   summary="Retrieve all jenis-mata-pelajarans",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = JenisMataPelajaran::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all jenis mata pelajaran.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all jenis mata pelajaran.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Jenis Mata Pelajaran"},
     *   path="/api/jenis-mata-pelajaran/store",
     *   summary="Create a new jenis-mata-pelajaran",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name", "description", "status"},
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="name", type="string"),
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
            'name' => 'required',
            'description' => 'required|string',
            'status' => 'required|boolean'
        ]);

        $data = JenisMataPelajaran::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new jenis mata pelajaran.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new jenis mata pelajaran.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Jenis Mata Pelajaran"},
     *   path="/api/jenis-mata-pelajaran/detail/{id}",
     *   summary="Retrieve a jenis-mata-pelajaran",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="jenis-mata-pelajaran ID",
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
        $data = JenisMataPelajaran::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve a jenis mata pelajaran.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved a jenis mata pelajaran.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Jenis Mata Pelajaran"},
     *   path="/api/jenis-mata-pelajaran/update/{id}",
     *   summary="Update a jenis-mata-pelajaran",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="jenis-mata-pelajaran ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name", "description", "status"},
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean")
     *    )
     *  ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *       @OA\JsonContent(
     *         type="object",
     *       @OA\Property(property="name", type="string"),
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
            'name' => 'required',
            'description' => 'required|string',
            'status' => 'required|boolean'
        ]);

        $data = JenisMataPelajaran::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve a jenis mata pelajaran.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated a jenis mata pelajaran.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Jenis Mata Pelajaran"},
     *   path="/api/jenis-mata-pelajaran/delete/{id}",
     *   summary="Delete a jenis-mata-pelajaran",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="jenis-mata-pelajaran ID",
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
        $data = JenisMataPelajaran::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve a jenis mata pelajaran.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted a jenis mata pelajaran.',
            'data' => $data
        ], 200);
    }
}
