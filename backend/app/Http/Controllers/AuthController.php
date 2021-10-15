<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function login()
    {
        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function resetPassword() 
    {
        $oldPassword = request("old_password");
        $newPassword = request("new_password");

        if (!Hash::check($oldPassword,auth()->user()->password)) {
            return response()->json(["message"=>"old password did not match"],422);
        }

        $user = auth()->user();
        $user->password = Hash::make($newPassword);
        DB::transaction(function () use ($user) {
            $user->save();
        });

        return response()->json(["message"=>"reset success, user logged out"]);
    }

    protected function respondWithToken($token)
    {
        $isPasswordDefault = auth()->user()->created_at == auth()->user()->updated_at;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'default_password'=>$isPasswordDefault
        ]);
    }


}
