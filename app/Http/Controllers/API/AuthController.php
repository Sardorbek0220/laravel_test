<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
    	$fields = $request->validate([
    		'name' => 'required',
    		'email' => 'required|string|unique:users,email',
    		'password' => 'required',
    	]);

    	$user = User::create([
    		'name' => $fields['name'],
    		'email' => $fields['email'],
    		'password' => bcrypt($fields['password']),
            'user_type_id' => 2
    	]);

    	$token = $user->createToken('myapptoken')->plainTextToken;

    	$response = [
    		'user' => $user,
    		'token' => $token,
    	];

    	return response($response, 201);

    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'bad'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'logged out'
        ];
    }

    public function apply(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function users()
    {
        return response()->json(User::paginate(10), 200);
    }
}
