<?php

namespace App\Http\Controllers;

use App\Models\KompetensiDasarDetail;
use Illuminate\Http\Request;

class KompetensiDasarDetailController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Kompetensi Dsar Detail"},
     *   path="/api/kompetensi-dasar-detail/list",
     *   summary="Retrieve all kompetensi-dasar-details",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = KompetensiDasarDetail::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all kompetensi dasar detail.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all kompetensi dasar detail.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Kompetensi Dsar Detail"},
     *   path="/api/kompetensi-dasar-detail/store",
     *   summary="Create a new kompetensi-dasar-detail",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"kompetensi_dasar_id", "name"},
     *       @OA\Property(property="kompetensi_dasar_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="kompetensi_dasar_id", type="string"),
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
            'kompetensi_dasar_id' => 'required',
            'name' => 'required'
        ]);

        $data = KompetensiDasarDetail::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new kompetensi dasar detail.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new kompetensi dasar detail.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Kompetensi Dsar Detail"},
     *   path="/api/kompetensi-dasar-detail/detail/{id}",
     *   summary="Retrieve a kompetensi-dasar-detail",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="kompetensi-dasar-detail ID",
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
        $data = KompetensiDasarDetail::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kompetensi dasar detail.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved kompetensi dasar detail.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Kompetensi Dsar Detail"},
     *   path="/api/kompetensi-dasar-detail/update/{id}",
     *   summary="Update a kompetensi-dasar-detail",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="kompetensi-dasar-detail ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"kompetensi_dasar_id", "name"},
     *       @OA\Property(property="kompetensi_dasar_id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="kompetensi_dasar_id", type="string"),
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
            'kompetensi_dasar_id' => 'required',
            'name' => 'required'
        ]);

        $data = KompetensiDasarDetail::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kompetensi dasar detail.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated kompetensi dasar detail.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Kompetensi Dsar Detail"},
     *   path="/api/kompetensi-dasar-detail/delete/{id}",
     *   summary="Delete a kompetensi-dasar-detail",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="kompetensi-dasar-detail ID",
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
        $data = KompetensiDasarDetail::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kompetensi dasar detail.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted kompetensi dasar detail.',
            'data' => $data
        ], 200);
    }
}
