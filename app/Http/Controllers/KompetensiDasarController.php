<?php

namespace App\Http\Controllers;

use App\Models\KompetensiDasar;
use Illuminate\Http\Request;

class KompetensiDasarController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Kompetensi Dasar"},
     *   path="/api/kompetensi-dasar/list",
     *   summary="Retrieve all kelass",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = KompetensiDasar::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all kompetensi dasar.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all kompetensi dasar.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Kompetensi Dasar"},
     *   path="/api/kompetensi-dasar/store",
     *   summary="Create a new kompetensi-dasar",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"silabus_id", "materi_pokok", "description", "kegiatan_pembelajaran", "sumber_belajar", "status"},
     *       @OA\Property(property="silabus_id", type="string"),
     *       @OA\Property(property="materi_pokok", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="kegiatan_pembelajaran", type="string"),
     *       @OA\Property(property="sumber_belajar", type="string"),
     *       @OA\Property(property="status", type="boolean")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="silabus_id", type="string"),
     *       @OA\Property(property="materi_pokok", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="kegiatan_pembelajaran", type="string"),
     *       @OA\Property(property="sumber_belajar", type="string"),
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
            'silabus_id' => 'required',
            'materi_pokok' => 'required',
            'description' => 'required',
            'kegiatan_pembelajaran' => 'required',
            'sumber_belajar' => 'required',
            'status' => 'required'
        ]);

        $data = KompetensiDasar::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new kompetensi dasar.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new kompetensi dasar.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Kompetensi Dasar"},
     *   path="/api/kompetensi-dasar/detail/{id}",
     *   summary="Retrieve a kompetensi-dasar",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="kelas ID",
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
        $data = KompetensiDasar::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kompetensi dasar.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved kompetensi dasar.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Kompetensi Dasar"},
     *   path="/api/kompetensi-dasar/update/{id}",
     *   summary="Update a kompetensi-dasar",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="kelas ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"silabus_id", "materi_pokok", "description", "kegiatan_pembelajaran", "sumber_belajar", "status"},
     *       @OA\Property(property="silabus_id", type="string"),
     *       @OA\Property(property="materi_pokok", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="kegiatan_pembelajaran", type="string"),
     *       @OA\Property(property="sumber_belajar", type="string"),
     *       @OA\Property(property="status", type="boolean")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="silabus_id", type="string"),
     *       @OA\Property(property="materi_pokok", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="kegiatan_pembelajaran", type="string"),
     *       @OA\Property(property="sumber_belajar", type="string"),
     *       @OA\Property(property="status", type="boolean"),
     *       @OA\Property(property="created_at", type="string"),
     *       @OA\Property(property="updated_at", type="string"),
     *       @OA\Property(property="deleted_at", type="string")
     *   )
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     *)
     *
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'silabus_id' => 'required',
            'materi_pokok' => 'required',
            'description' => 'required',
            'kegiatan_pembelajaran' => 'required',
            'sumber_belajar' => 'required',
            'status' => 'required'
        ]);

        $data = KompetensiDasar::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kompetensi dasar.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated kompetensi dasar.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Kompetensi Dasar"},
     *   path="/api/kompetensi-dasar/delete/{id}",
     *   summary="Delete a kompetensi-dasar",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="kelas ID",
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
        $data = KompetensiDasar::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve kompetensi dasar.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted kompetensi dasar.',
            'data' => $data
        ], 200);
    }
}
