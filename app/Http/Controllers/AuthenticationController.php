<?php

namespace App\Http\Controllers;

use App\Models\authentication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users']=User::all();
        return view('user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'is_admin' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->is_admin = $request->is_admin;
        $user->save();

        return redirect()->route('authentication.create')->with('success','successully save');
    }

    /**
     * Display the specified resource.
     */
    public function show(authentication $authentication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(authentication $authentication,$id)
    {
        $data['user']=User::find($id);
        return view('user.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, authentication $authentication,$id)
    {
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->is_admin=$request->is_admin;
        $user->update();

        return redirect()->route('authentication.index')->with('success','successfully update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(authentication $authentication,$id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->route('authentication.index')->with('success','successfully delete');
    }


    // sign in
    public function signIn()
    {
        return view('authentication.signIn');
    }

    // sign up
    public function signUp()
    {
        return view('authentication.signup');
    }
}
