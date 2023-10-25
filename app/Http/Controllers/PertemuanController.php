<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Pertemuan"},
     *   path="/api/pertemuan/list",
     *   summary="Retrieve all pertemuans",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = Pertemuan::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all pertemuan.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all pertemuan.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Pertemuan"},
     *   path="/api/pertemuan/store",
     *   summary="Create a new pertemuan",
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

        $data = Pertemuan::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new pertemuan.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new pertemuan.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Pertemuan"},
     *   path="/api/pertemuan/detail/{id}",
     *   summary="Retrieve a pertemuan",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="pertemuan ID",
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
        $data = Pertemuan::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve pertemuan.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved pertemuan.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Pertemuan"},
     *   path="/api/pertemuan/update/{id}",
     *   summary="Update a pertemuan",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="pertemuan ID",
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

        $data = Pertemuan::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve pertemuan.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated pertemuan.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Pertemuan"},
     *   path="/api/pertemuan/delete/{id}",
     *   summary="Delete a pertemuan",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="pertemuan ID",
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
        $data = Pertemuan::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve pertemuan.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted pertemuan.',
            'data' => $data
        ], 200);
    }
}
