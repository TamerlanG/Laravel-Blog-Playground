<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ReaderRegisterRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\WriterRegisterRequest;
use App\Models\Reader;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ReaderController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Reader only route success',
        ], 200);
    }

    /**
     * Register a user
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(ReaderRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = Reader::create(array_merge(
            $data,
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'Reader successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Get a JWT via given credentials
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = Reader::where('email', $data['email'])->first();

        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if(!Hash::check($data['password'], $user->password)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('Laravel Password Grant Client', ['reader'])->accessToken;
        $response = ['token' => $token];
        return response()->json($response);
    }
}
