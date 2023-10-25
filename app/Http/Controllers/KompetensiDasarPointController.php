<?php

namespace App\Http\Controllers;

use App\Models\KompetensiDasarPoint;
use Illuminate\Http\Request;

class KompetensiDasarPointController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Kompetensi Dasar Point"},
     *   path="/api/kompetensi-dasar-point/list",
     *   summary="Retrieve all kompetensi-dasar-points",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = KompetensiDasarPoint::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all kompetensi dasar point.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all kompetensi dasar point.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Kompetensi Dasar Point"},
     *   path="/api/kompetensi-dasar-point/store",
     *   summary="Create a new kompetensi-dasar-point",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"kompetensi_dasar_detail_id", "name"},
     *       @OA\Property(property="kompetensi_dasar_detail_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="kompetensi_dasar_detail_id", type="string"),
     *       @OA\Property(property="name", type="string"),
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
            'kompetensi_dasar_detail_id' => 'required',
            'name' => 'required',
        ]);

        $data = KompetensiDasarPoint::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new kompetensi dasar point.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new kompetensi dasar point.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Kompetensi Dasar Point"},
     *   path="/api/kompetensi-dasar-point/detail/{id}",
     *   summary="Retrieve a kompetensi-dasar-point",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="kompetensi-dasar-point ID",
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
        $data = KompetensiDasarPoint::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kompetensi dasar point.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved kompetensi dasar point.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Kompetensi Dasar Point"},
     *   path="/api/kompetensi-dasar-point/update/{id}",
     *   summary="Update a kompetensi-dasar-point",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="kompetensi-dasar-point ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"kompetensi_dasar_detail_id", "name"},
     *       @OA\Property(property="kompetensi_dasar_detail_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="kompetensi_dasar_detail_id", type="string"),
     *       @OA\Property(property="name", type="string"),
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
            'kompetensi_dasar_detail_id' => 'required',
            'name' => 'required',
        ]);

        $data = KompetensiDasarPoint::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kompetensi dasar point.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated kompetensi dasar point.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Kompetensi Dasar Point"},
     *   path="/api/kompetensi-dasar-point/delete/{id}",
     *   summary="Delete a kompetensi-dasar-point",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="kompetensi-dasar-point ID",
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
        $data = KompetensiDasarPoint::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kompetensi dasar point.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted kompetensi dasar point.',
            'data' => $data
        ], 200);
    }
}
