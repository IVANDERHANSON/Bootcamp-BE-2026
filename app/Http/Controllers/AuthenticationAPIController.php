<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationAPIController extends Controller
{
    function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ], [
            'name.required' => 'Name harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Harus dalam format email.',
            'email.unique' => 'Email sudah terpakai.',
            'password.required' => 'Password harus diisi.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Register gagal.',
                'error' => $validator->customMessages
            ], 400);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Register berhasil.'
        ], 200);
    }

    function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Harus dalam format email.',
            'password.required' => 'Password harus diisi.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Login gagal.',
                'error' => $validator->customMessages
            ], 400);
        }
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 400,
                'message' => 'Login gagal.',
                'error' => 'Credentials tidak ditemukan.'
            ], 400);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Login berhasil.',
            'token' => $user->createToken(rand(1000, 9999))->plainTextToken
        ], 200);
    }

    function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Logout berhasil.'
        ], 200);
    }
}
