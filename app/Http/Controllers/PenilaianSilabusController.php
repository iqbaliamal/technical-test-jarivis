<?php

namespace App\Http\Controllers;

use App\Models\PenilaianSilabus;
use Illuminate\Http\Request;

class PenilaianSilabusController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Penilaian Silabus"},
     *   path="/api/penilaian-silabus/list",
     *   summary="Retrieve all penilaian-silabuss",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = PenilaianSilabus::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all penilaian silabus.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all penilaian silabus.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Penilaian Silabus"},
     *   path="/api/penilaian-silabus/store",
     *   summary="Create a new penilaian-silabus",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"penilaian_id", "silabus_id", "name", "value"},
     *       @OA\Property(property="penilaian_id", type="string"),
     *       @OA\Property(property="silabus_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="value", type="string")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="penilaian_id", type="string"),
     *       @OA\Property(property="silabus_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="value", type="string"),
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
            'penilaian_id' => 'required',
            'silabus_id' => 'required',
            'name' => 'required',
            'value' => 'required'
        ]);

        $data = PenilaianSilabus::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new penilaian silabus.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new penilaian silabus.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Penilaian Silabus"},
     *   path="/api/penilaian-silabus/detail/{id}",
     *   summary="Retrieve a penilaian-silabus",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="penilaian-silabus ID",
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
        $data = PenilaianSilabus::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve penilaian silabus.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved penilaian silabus.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Penilaian Silabus"},
     *   path="/api/penilaian-silabus/update/{id}",
     *   summary="Update a penilaian-silabus",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="penilaian-silabus ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"penilaian_id", "silabus_id", "name", "value"},
     *       @OA\Property(property="penilaian_id", type="string"),
     *       @OA\Property(property="silabus_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="value", type="string")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="penilaian_id", type="string"),
     *       @OA\Property(property="silabus_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="value", type="string"),
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
            'penilaian_id' => 'required',
            'silabus_id' => 'required',
            'name' => 'required',
            'value' => 'required'
        ]);

        $data = PenilaianSilabus::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve penilaian silabus.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated penilaian silabus.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Penilaian Silabus"},
     *   path="/api/penilaian-silabus/delete/{id}",
     *   summary="Delete a penilaian-silabus",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="penilaian-silabus ID",
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
        $data = PenilaianSilabus::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve penilaian silabus.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted penilaian silabus.',
            'data' => $data
        ], 200);
    }
}
