<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Users=User::paginate(10);

        return response()->json($Users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        //
        $validated=$request->validated();

        $user=User::create([
            'name'=> $validated['name'],
            'email'=> $validated['email'],
            'password'=> Hash::make($validated['password'])

        ]);

        return response()->json(['user'=>$user,
            'message'=>'user created successfully!']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user=User::find($id);

        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user=User::find($id);

        $user->delete();

        return response()->json(['message'=>'user deleted successfully!']);
    }

    public function userAuthentication(Request $req){

        $credentials=[
            'email'=>$req['email'],
            'password'=> $req['password']
        ];

        if(Auth::attempt($credentials)){

            $remeberToken=Str::random(60);

            $user=Auth::user();
            $user->remember_Token=$remeberToken;

            $user->save();

            return response()->json(['message' => 'Authenticated successfully.', 'remember_token' => $remeberToken]);


        };

        return response()->json(['error' => 'Invalid credentials.'], 401);

    }
}
