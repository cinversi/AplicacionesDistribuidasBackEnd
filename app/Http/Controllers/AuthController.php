<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
   {
     $this->middleware('auth:api')->only('logout');
   }
   public function getCurrentUser(): User
   {
     return request()->user();
   }
    public function login(Request $request): JsonResponse
   {
    $credentials = $this->validate($request, [
        'email'    => 'required|email|exists:users',
        'password' => 'required|min:5',
    ]);

    if (auth()->attempt($credentials)) {
        $user = auth()->user();
        /** @var User $user */
        $user['token'] = $this->generateTokenForUser($user);

        return response()->json($user);
    } else {
        return response()->json(['success' => 'false', 'message' => 'Authentication failed'], 401);
    }
 }
}
