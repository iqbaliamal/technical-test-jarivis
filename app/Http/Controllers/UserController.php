<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data = User::all();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve all users.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all users.',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sekolah_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required'
        ]);

        $data = User::create($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create a new user.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully created a new user.',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $id)
    {
        $data = User::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve a user.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved a user.',
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'sekolah_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required'
        ]);

        $data = User::find($id)->update($validated);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update a user.',
                'data' => ''
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated a user.',
            'data' => $validated
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id)->delete();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
                'data' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted a user.',
            'data' => $data
        ], 200);
    }
}
