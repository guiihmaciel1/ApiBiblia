<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function register(Request $request){
        $fields = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed',
            ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        //token
        $token = $user->createToken($request->nameToken)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);


        //  1|aBwbZxzhXnxx1RrAhcyiK0L8v7LNn1804qL84RTT
        //  2|4hLEbHsfuyG66Y7Zte3fIuHrHeMj5GscjcIHjatc
        //  3|CN7Fs9SHjVaVoo9uUN5lVwLUJZ4ZWfe4qex6pDo1
   }

   public function login(Request $request)
   {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message'   => 'Email ou Senha Inválidos'
            ],401);
        }

        $token = $user->createToken('UsuarioLogado')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);

   }

   public function logout(Request $request)
   {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Deslogado com Sucesso',
        ],200);

   }

}
