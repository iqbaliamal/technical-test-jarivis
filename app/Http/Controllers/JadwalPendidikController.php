<?php

namespace App\Http\Controllers;

use App\Models\JadwalPendidik;
use Illuminate\Http\Request;

class JadwalPendidikController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Jadwal Pendidik"},
     *   path="/api/jadwal-pendidik/list",
     *   summary="Retrieve all jadwal-pendidiks",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = JadwalPendidik::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all jadwal pendidik.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all jadwal pendidik.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Jadwal Pendidik"},
     *   path="/api/jadwal-pendidik/store",
     *   summary="Create a new jadwal-pendidik",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"user_id", "mata_pelajaran_id", "description", "status"},
     *       @OA\Property(property="user_id", type="string"),
     *       @OA\Property(property="mata_pelajaran_id", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="user_id", type="string"),
     *       @OA\Property(property="mata_pelajaran_id", type="string"),
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
            'user_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $data = JadwalPendidik::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new jadwal pendidik.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new jadwal pendidik.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Jadwal Pendidik"},
     *   path="/api/jadwal-pendidik/detail/{id}",
     *   summary="Retrieve a jadwal-pendidik",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="jadwal-pendidik ID",
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
        $data = JadwalPendidik::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve jadwal pendidik.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved jadwal pendidik.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Jadwal Pendidik"},
     *   path="/api/jadwal-pendidik/update/{id}",
     *   summary="Update a jadwal-pendidik",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="jadwal-pendidik ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"user_id", "mata_pelajaran_id", "description", "status"},
     *       @OA\Property(property="user_id", type="string"),
     *       @OA\Property(property="mata_pelajaran_id", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean")
     *    )
     *  ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *       @OA\JsonContent(
     *         type="object",
     *       @OA\Property(property="user_id", type="string"),
     *       @OA\Property(property="mata_pelajaran_id", type="string"),
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
            'user_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $data = JadwalPendidik::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve jadwal pendidik.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated jadwal pendidik.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Jadwal Pendidik"},
     *   path="/api/jadwal-pendidik/delete/{id}",
     *   summary="Delete a jadwal-pendidik",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="jadwal-pendidik ID",
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
        $data = JadwalPendidik::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve jadwal pendidik.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted jadwal pendidik.',
            'data' => $data
        ], 200);
    }
}
