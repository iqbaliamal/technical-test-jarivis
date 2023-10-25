<?php

namespace App\Http\Controllers;

use App\Models\Rpp;
use Illuminate\Http\Request;

class RppController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"RPP"},
     *   path="/api/rpp/list",
     *   summary="Retrieve all rpps",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = Rpp::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all rpp.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all rpp.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"RPP"},
     *   path="/api/rpp/store",
     *   summary="Create a new rpp",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"kelas_id", "jadwal_pendidik_id","kompetensi_dasar_id", "alokasi_wakktu_id", "materi", "tujuan", "kegiatan", "alat", "sumber", "pendahuluan", "penutupan", "status"},
     *       @OA\Property(property="kelas_id", type="string"),
     *       @OA\Property(property="jadwal_pendidik_id", type="string"),
     *       @OA\Property(property="kompetensi_dasar_id", type="string"),
     *       @OA\Property(property="alokasi_waktu_id", type="string"),
     *       @OA\Property(property="materi", type="string"),
     *       @OA\Property(property="tujuan", type="string"),
     *       @OA\Property(property="kegiatan", type="string"),
     *       @OA\Property(property="alat", type="string"),
     *       @OA\Property(property="sumber", type="string"),
     *       @OA\Property(property="pendahuluan", type="string"),
     *       @OA\Property(property="penutupan", type="string"),
     *       @OA\Property(property="status", type="boolean"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="kelas_id", type="string"),
     *       @OA\Property(property="jadwal_pendidik_id", type="string"),
     *       @OA\Property(property="kompetensi_dasar_id", type="string"),
     *       @OA\Property(property="alokasi_waktu_id", type="string"),
     *       @OA\Property(property="materi", type="string"),
     *       @OA\Property(property="tujuan", type="string"),
     *       @OA\Property(property="kegiatan", type="string"),
     *       @OA\Property(property="alat", type="string"),
     *       @OA\Property(property="sumber", type="string"),
     *       @OA\Property(property="pendahuluan", type="string"),
     *       @OA\Property(property="penutupan", type="string"),
     *       @OA\Property(property="status", type="boolean"),
     *       @OA\Property(property="created_at", type="string"),
     *       @OA\Property(property="updated_at", type="string"),
     *       @OA\Property(property="deleted_at", type="string")
     *      ),
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required',
            'jadwal_pendidik_id' => 'required',
            'kompetensi_dasar_id' => 'required',
            'alokasi_waktu_id' => 'required',
            'materi' => 'required',
            'tujuan' => 'required',
            'kegiatan' => 'required',
            'alat' => 'required',
            'sumber' => 'required',
            'pendahuluan' => 'required',
            'penutupan' => 'required',
            'status' => 'required|boolean'
        ]);

        $data = Rpp::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new rpp.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new rpp.',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"RPP"},
     *   path="/api/rpp/detail/{id}",
     *   summary="Retrieve a rpp",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="rpp ID",
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
        $data = Rpp::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve rpp.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved rpp.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"RPP"},
     *   path="/api/rpp/update/{id}",
     *   summary="Update a rpp",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="rpp ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"kelas_id", "jadwal_pendidik_id","kompetensi_dasar_id", "alokasi_wakktu_id", "materi", "tujuan", "kegiatan", "alat", "sumber", "pendahuluan", "penutupan", "status"},
     *       @OA\Property(property="kelas_id", type="string"),
     *       @OA\Property(property="jadwal_pendidik_id", type="string"),
     *       @OA\Property(property="kompetensi_dasar_id", type="string"),
     *       @OA\Property(property="alokasi_waktu_id", type="string"),
     *       @OA\Property(property="materi", type="string"),
     *       @OA\Property(property="tujuan", type="string"),
     *       @OA\Property(property="kegiatan", type="string"),
     *       @OA\Property(property="alat", type="string"),
     *       @OA\Property(property="sumber", type="string"),
     *       @OA\Property(property="pendahuluan", type="string"),
     *       @OA\Property(property="penutupan", type="string"),
     *       @OA\Property(property="status", type="boolean"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="kelas_id", type="string"),
     *       @OA\Property(property="jadwal_pendidik_id", type="string"),
     *       @OA\Property(property="kompetensi_dasar_id", type="string"),
     *       @OA\Property(property="alokasi_waktu_id", type="string"),
     *       @OA\Property(property="materi", type="string"),
     *       @OA\Property(property="tujuan", type="string"),
     *       @OA\Property(property="kegiatan", type="string"),
     *       @OA\Property(property="alat", type="string"),
     *       @OA\Property(property="sumber", type="string"),
     *       @OA\Property(property="pendahuluan", type="string"),
     *       @OA\Property(property="penutupan", type="string"),
     *       @OA\Property(property="status", type="boolean"),
     *       @OA\Property(property="created_at", type="string"),
     *       @OA\Property(property="updated_at", type="string"),
     *       @OA\Property(property="deleted_at", type="string")
     *      ),
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     *
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kelas_id' => 'required',
            'jadwal_pendidik_id' => 'required',
            'kompetensi_dasar_id' => 'required',
            'alokasi_waktu_id' => 'required',
            'materi' => 'required',
            'tujuan' => 'required',
            'kegiatan' => 'required',
            'alat' => 'required',
            'sumber' => 'required',
            'pendahuluan' => 'required',
            'penutupan' => 'required',
            'status' => 'required|boolean'
        ]);

        $data = Rpp::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve rpp.',
                'data' => ''
            ], 400);
        }

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated rpp.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"RPP"},
     *   path="/api/rpp/delete/{id}",
     *   summary="Delete a rpp",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="rpp ID",
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
        $data = Rpp::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve rpp.',
                'data' => ''
            ], 400);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted rpp.',
            'data' => $data
        ], 200);
    }
}
