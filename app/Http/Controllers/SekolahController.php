<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Sekolah"},
     *   path="/api/sekolah/list",
     *   summary="Retrieve all sekolahs",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = Sekolah::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all sekolah.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all sekolah.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Sekolah"},
     *   path="/api/sekolah/store",
     *   summary="Create a new sekolah",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"role_id", "name", "singkatan", "description", "status"},
     *       @OA\Property(property="role_id", type="string"),
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
     *       @OA\Property(property="role_id", type="string"),
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
            'role_id' => 'nullable|uuid|exists:roles,id',
            'name' => 'required|string|max:50|unique:sekolahs',
            'singkatan' => 'required|string|max:10|unique:sekolahs',
            'description' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $data = Sekolah::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new sekolah.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new sekolah.',
            'data' => $validated
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Sekolah"},
     *   path="/api/sekolah/detail/{id}",
     *   summary="Retrieve a sekolah",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="sekolah ID",
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
        $data = Sekolah::where('id', $id)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Sekolah not found.',
                'data' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved a sekolah.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Sekolah"},
     *   path="/api/sekolah/update/{id}",
     *   summary="Update a sekolah",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Sekolah ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"role_id", "name", "singkatan", "description", "status"},
     *       @OA\Property(property="role_id", type="string"),
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
     *       @OA\Property(property="role_id", type="string"),
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
            'role_id' => 'nullable|uuid|exists:roles,id',
            'name' => 'required|string|max:50|unique:sekolahs,name,' . $id,
            'singkatan' => 'required|string|max:10|unique:sekolahs,singkatan,' . $id,
            'description' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $data = Sekolah::where('id', $id)->update($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update a sekolah.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated a sekolah.',
            'data' => $validated
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Sekolah"},
     *   path="/api/sekolah/delete/{id}",
     *   summary="Delete a sekolah",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="sekolah ID",
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
        $data = Sekolah::where('id', $id)->delete();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete a sekolah.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted a sekolah.',
            'data' => $data
        ], 200);
    }
}
