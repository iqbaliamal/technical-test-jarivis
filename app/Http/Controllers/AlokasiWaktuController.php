<?php

namespace App\Http\Controllers;

use App\Models\AlokasiWaktu;
use Illuminate\Http\Request;

class AlokasiWaktuController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Alokasi Waktu"},
     *   path="/api/alokasi-waktu/list",
     *   summary="Retrieve all alokasi-waktus",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = AlokasiWaktu::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all alokasi waktu.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all alokasi waktu.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Alokasi Waktu"},
     *   path="/api/alokasi-waktu/store",
     *   summary="Create a new alokasi-waktu",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name"},
     *       @OA\Property(property="name", type="string"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
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
            'name' => 'required',
        ]);

        $data = AlokasiWaktu::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new alokasi waktu.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new alokasi waktu.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Alokasi Waktu"},
     *   path="/api/alokasi-waktu/detail/{id}",
     *   summary="Retrieve a alokasi-waktu",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="alokasi-waktu ID",
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
        $data = AlokasiWaktu::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve alokasi waktu.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved alokasi waktu.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Alokasi Waktu"},
     *   path="/api/alokasi-waktu/update/{id}",
     *   summary="Update a alokasi-waktu",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="alokasi-waktu ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name"},
     *       @OA\Property(property="name", type="string"),
     *    )
     *  ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *       @OA\JsonContent(
     *         type="object",
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
            'name' => 'required',
        ]);

        $data = AlokasiWaktu::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve alokasi waktu.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated alokasi waktu.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Alokasi Waktu"},
     *   path="/api/alokasi-waktu/delete/{id}",
     *   summary="Delete a alokasi-waktu",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="alokasi-waktu ID",
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
        $data = AlokasiWaktu::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Alokasi waktu not found.',
                'data' => ''
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted alokasi waktu.',
            'data' => $data
        ], 200);
    }
}
