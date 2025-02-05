<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    public function index()
    {
        return to_route('user.create');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserCreateRequest $request)
    {
        User::create([
            'name'          => $request->first_name . ' ' . $request->last_name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);
        return back()->with('success', 'User created successfully!');
    }
    public function userData()
    {
        $users = User::all();
        return response()->json($users);
    }
}
