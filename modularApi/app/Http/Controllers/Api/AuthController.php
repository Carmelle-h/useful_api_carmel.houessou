<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    //  Inscription of an user 
    public function register(RegisterRequest $request): JsonResponse
    {
        try{

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            return response()->json([
                'message' => 'Registration successful.',
            ], 201);
        } catch (\Exception $e) {
            // Gérer les erreurs 
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'errors' => [
                    'server' => ['Erreur serveur : ' . $e->getMessage()]
                ]
            ], 500);
        }
    }

    // login 
    public function login(LoginRequest $request): JsonResponse
    {

        try {
            $validateData = $request->only('email', 'password');
            if(!Auth::attempt($validateData)){
                return response()->json([
                    'massage' => 'Données incorrectes',
                ], 401);
            }
            $user = Auth::user();
            // create token 
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Connexion succeed',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => Auth::user(),
            ], 200);
        } catch (\Exception $e) {
             return response()->json([
                'success' => false,
                'message' => 'Error during authentification'.$e,
                'errors' => [
                    'server' => [' Server error']
                ]
            ], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

}
