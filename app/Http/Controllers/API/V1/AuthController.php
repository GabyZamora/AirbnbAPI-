<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\API\V1\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registro(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $token = $user->createToken($request->email)->plainTextToken;

        //$user->assignRole('invitado');

        return response()->json([
            'res' => true,
            'token' => $token,
            'usuario' => $user,
            'msg' => 'Registrado correctamente'
        ],200);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'msg' => ['Las credenciales son incorrectas.'],
            ]);
        }
     
        $token = $user->createToken($request->email)->plainTextToken;

        return response([
            'res' => true,
            'token' => $token,
            'usuario' => $user
        ],200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response([
            'res' => true,
            'msg' => 'Token eliminado correctamente'
        ],200);
    }
}
