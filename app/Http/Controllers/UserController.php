<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{
    public function show()
    {
        return request()->user();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:125|unique:users',
            'password' => 'required|string|max:125',
            'password2' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return $this->api_fail(['ValidationErorrs' => $validator->errors()->all()], 400);
        }
        $validated = $validator->validated();

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return $this->api_ok();
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:125',
            'password' => 'required|string|max:125',
            'token_name' => ''
        ]);
        if ($validator->fails()) {
            return $this->api_fail(['ValidationErorrs' => $validator->errors()->all()], 400);
        }
        $validated = $validator->validated();
        
        if (auth()->once($validated)) {
            $tokenName = $request->token_name ?? 'mainToken';
            /** @var User $user */
            $user = auth()->user();
            
            $user->tokens()->where('name', $tokenName)->delete();
            $token = $user->createToken($tokenName);

            return response($token->plainTextToken);
        } else {
            return $this->api_fail(null, 401);
        }
    }

    public function refresh() {
        /** @var User $user */
        $user = auth()->user();

        /** @var PersonalAccessToken */
        $currentToken = $user->currentAccessToken();
        $tokenName = $currentToken->name;
        $currentToken->delete();
        
        $token = $user->createToken($tokenName);
        return response($token->plainTextToken);
    }
}
