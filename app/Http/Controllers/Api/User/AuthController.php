<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //


    /**
     * @param AuthRequest $request
     * @return JsonResponse
     */
    function login(LoginRequest $request)
    {
        $status = $request->authenticate();
        if ($status) return $status;
//        $request->session()->regenerate();
        $user = User::where('email', $request->email)->first();
        $authToken = $user->createToken('auth-token')->plainTextToken;
        return response()->json(["status" => "ok", "access_token" => $authToken]);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => "",
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            "status" => "ok"
        ]);
    }

    public function logout(Request $request)
    {


        // Удаление записи сессии из базы данных
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return response()->json([
            'status' => 'ok',
            'message' => 'Logged out successfully'
        ]);
    }
}
