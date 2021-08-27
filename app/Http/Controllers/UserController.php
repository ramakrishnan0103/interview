<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    
    public function login(Request $request)
    {
        // Are the proper fields present?
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response()->json(['message' => $validator->errors()], 422);
        } 
        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            // Login has failed
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondwithToken($token);
    }
    public function logout() {
        auth()->guard('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh the current token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
      return $this->respondWithToken( auth()->refresh() );
    }
    private function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
	        'token_type' => 'bearer',
	        'user'=>Auth::guard('api')->user(),
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 7 * 24 * 60 
        ], 200);
    }
}
