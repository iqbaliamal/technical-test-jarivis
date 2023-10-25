<?php

namespace App\Http\Controllers;

use App\Models\Silabus;
use Illuminate\Http\Request;

class SilabusController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Silabus"},
     *   path="/api/silabus/list",
     *   summary="Retrieve all silabuss",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = Silabus::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all silabus.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all silabus.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Silabus"},
     *   path="/api/silabus/store",
     *   summary="Create a new silabus",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"sekolah_id", "mata_pelajaran_id", "kelas_id", "name", "description", "status"},
     *       @OA\Property(property="sekolah_id", type="string"),
     *       @OA\Property(property="mata_pelajaran_id", type="string"),
     *       @OA\Property(property="kelas_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean"),
     *     )
     *   ),
     *   @OA\Response(response=201, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sekolah_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'kelas_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $data = Silabus::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new silabus.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new silabus.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Silabus"},
     *   path="/api/silabus/detail/{id}",
     *   summary="Retrieve a silabus",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="silabus ID",
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
        $data = Silabus::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve silabus.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved silabus.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Silabus"},
     *   path="/api/silabus/update/{id}",
     *   summary="Update a silabus",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="silabus ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"sekolah_id", "mata_pelajaran_id", "kelas_id", "name", "description", "status"},
     *       @OA\Property(property="sekolah_id", type="string"),
     *       @OA\Property(property="mata_pelajaran_id", type="string"),
     *       @OA\Property(property="kelas_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="status", type="boolean"),
     *     )
     *   ),
     *   @OA\Response(response=201, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     *
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'sekolah_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'kelas_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $data = Silabus::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve silabus.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated silabus.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Silabus"},
     *   path="/api/silabus/delete/{id}",
     *   summary="Delete a silabus",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="silabus ID",
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
        $data = Silabus::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Silabus not found.',
                'data' => ''
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted silabus.',
            'data' => $data
        ], 200);
    }
}
