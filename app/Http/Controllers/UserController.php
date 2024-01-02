<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new user
     * @param Request $request
     * @return Response
     */
    public function createUser(Request $request) {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string'
            ]);
            if($validateUser->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'error' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'message' => 'User created',
                'token' => $user->createToken('api_token')->plainTextToken
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Login User by email and password
     * @param Request $request
     * @return Response
     */
    public function loginUser(Request $request) {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string'
            ]);
            if($validateUser->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'error' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'message' => 'Email and password does not match with our record',
                    'error' => $validateUser->errors()
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'message' => 'User logged',
                'token' => $user->createToken('api_token')->plainTextToken
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
