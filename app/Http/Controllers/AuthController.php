<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class AuthController extends Controller
{
    public function registration(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->username;

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Membuat Akun',
            'data' => $success
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
     
    //     $user = User::where('email', $request->email)->first();
     
    //     if (! $user || ! Hash::check($request->password, $user->password)) {
    //         throw ValidationException::withMessages([
    //             'email' => ['The provided credentials are incorrect.'],
    //         ]);
    //     }
     
    //     return $user->createToken('User Login')->plainTextToken;
    // }

    // public function logout(Request $request)
    // {
      
    //     $request->user()->tokens()->delete();

    //     return response()->json(['message' => 'Logout successful'], 200);
    // }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anda Berhasil Logout',
        ]);
    }

    public function user(Request $request)
    {
        return response()->json(Auth::user());
    }
}
