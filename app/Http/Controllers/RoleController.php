<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Roles"},
     *   path="/api/role/list",
     *   summary="Retrieve all roles",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function list()
    {
        $data = DB::table('roles')->get();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all roles.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all roles.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Roles"},
     *   path="/api/role/store",
     *   summary="Create a new role",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"xxx"},
     *       @OA\Property(property="xxx", type="string")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent( type="object", @OA\Property(property="xxx", type="string") )
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:roles',
            'description' => 'nullable|string|max:255',
            'status' => 'nullable|boolean'
        ]);

        $data = Role::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new role.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new role.',
            'data' => $validated
        ], 201);
    }

    /**
     * @OA\Get(
     *   tags={"Roles"},
     *   path="/api/role/detail/{id}",
     *   summary="Retrieve a role",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Role ID",
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
        $data = DB::table('roles')->where('id', $id)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found.',
                'data' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved a role.',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Put(
     *   tags={"Roles"},
     *   path="/api/role/update/{id}",
     *   summary="Update a role",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Role ID",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"xxx"},
     *       @OA\Property(property="xxx", type="string")
     *       )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *       @OA\JsonContent( type="object", @OA\Property(property="xxx", type="string") )
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:roles,name,' . $id,
            'description' => 'nullable|string|max:255',
            'status' => 'nullable|boolean'
        ]);

        $data = DB::table('roles')->where('id', $id)->update($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update a role.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated a role.',
            'data' => $validated
        ], 200);
    }

    /**
     * @OA\Delete(
     *   tags={"Roles"},
     *   path="/api/role/delete/{id}",
     *   summary="Delete a role",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Role ID",
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
        $data = DB::table('roles')->where('id', $id)->delete();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found.',
                'data' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted a role.',
            'data' => $data
        ], 200);
    }
}
