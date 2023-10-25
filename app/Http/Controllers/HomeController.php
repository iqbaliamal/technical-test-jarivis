<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"TEST CASE QUERY"},
     *   path="/api/murid-terbanyak",
     *   summary="Retrieve murid terbanyak",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function muridTerbanyak()
    {
        $data = DB::table('users')
            ->join('sekolahs', 'users.sekolah_id', '=', 'sekolahs.id')
            ->select('sekolahs.name', 'sekolahs.singkatan', DB::raw('count(users.id) as total'))
            ->where('users.role', '=', 'siswa')
            ->groupBy('sekolahs.name', 'sekolahs.singkatan')
            ->orderBy('total', 'desc')
            ->get();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve data.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved data.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Get(
     *   tags={"TEST CASE QUERY"},
     *   path="/api/jadwal-pendidik-terbanyak",
     *   summary="Retrieve jadwal pendidik terbanyak",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function jadwalPendidikTerbanyak()
    {
        $data = DB::table('jadwal_pendidiks')
            ->join('users', 'jadwal_pendidiks.user_id', '=', 'users.id')
            ->join('sekolahs', 'users.sekolah_id', '=', 'sekolahs.id')
            ->select('sekolahs.name', 'sekolahs.singkatan', DB::raw('count(jadwal_pendidiks.id) as total'))
            ->groupBy('sekolahs.name', 'sekolahs.singkatan')
            ->orderBy('total', 'desc')
            ->get();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve data.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved data.',
            'data' => $data
        ], 200);
    }
}
