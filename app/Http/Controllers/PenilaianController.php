<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Penilaian"},
     *   path="/api/penilaian/list",
     *   summary="Retrieve all penilaians",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = Penilaian::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all penilaian.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all penilaian.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Penilaian"},
     *   path="/api/penilaian/store",
     *   summary="Create a new penilaian",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name", "type"},
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="type", type="pengetahuan|keterampilan"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="type", type="string"),
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
            'type' => 'required|in:pengetahuan,keterampilan',
        ]);

        $data = Penilaian::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new penilaian.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new penilaian.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Penilaian"},
     *   path="/api/penilaian/detail/{id}",
     *   summary="Retrieve a penilaian",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="penilaian ID",
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
        $data = Penilaian::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve penilaian.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved penilaian.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Penilaian"},
     *   path="/api/penilaian/update/{id}",
     *   summary="Update a penilaian",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="penilaian ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name", "type"},
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="type", type="pengetahuan|keterampilan"),
     *    )
     *  ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *       @OA\JsonContent(
     *         type="object",
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="type", type="string"),
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
            'type' => 'required|in:pengetahuan,keterampilan',
        ]);

        $data = Penilaian::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve penilaian.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated penilaian.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Penilaian"},
     *   path="/api/penilaian/delete/{id}",
     *   summary="Delete a penilaian",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="penilaian ID",
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
        $data = Penilaian::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve penilaian.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted penilaian.',
            'data' => $data
        ], 200);
    }
}
