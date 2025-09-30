<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = DB::table('users')
            ->select('id', 'name', 'email', 'created_at', 'updated_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($users);
    }

    public function show(int $id): JsonResponse
    {
        $user = DB::table('users')
            ->select('id', 'name', 'email', 'created_at', 'updated_at')
            ->where('id', $id)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $userId = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = DB::table('users')
            ->select('id', 'name', 'email', 'created_at', 'updated_at')
            ->where('id', $userId)
            ->first();

        return response()->json($user, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        $updateData = [];

        if ($request->has('name')) {
            $updateData['name'] = $request->name;
        }

        if ($request->has('email')) {
            $updateData['email'] = $request->email;
        }

        if ($request->has('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        if (!empty($updateData)) {
            $updateData['updated_at'] = now();

            DB::table('users')
                ->where('id', $id)
                ->update($updateData);
        }

        $updatedUser = DB::table('users')
            ->select('id', 'name', 'email', 'created_at', 'updated_at')
            ->where('id', $id)
            ->first();

        return response()->json($updatedUser);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        DB::table('users')->where('id', $id)->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function search(Request $request): JsonResponse
    {
        $query = DB::table('users')
            ->select('id', 'name', 'email', 'created_at', 'updated_at');

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->has('created_after')) {
            $query->where('created_at', '>=', $request->created_after);
        }

        if ($request->has('created_before')) {
            $query->where('created_at', '<=', $request->created_before);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return response()->json($users);
    }

    public function count(): JsonResponse
    {
        $count = DB::table('users')->count();

        return response()->json(['count' => $count]);
    }
}