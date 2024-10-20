<?php

namespace App\Http\Controllers;

use App\Models\authentication;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(authentication $authentication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, authentication $authentication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(authentication $authentication)
    {
        //
    }
}
