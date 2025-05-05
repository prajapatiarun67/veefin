<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\createUser;
use App\Http\Requests\user\userLogin;
use App\Models\AuthModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    protected $data = array();

    public function __construct()
    {
        
    }
   
    public function showHoLoginForm()
    {
        $this->data['title'] = "Login";
        if (Session::has('user')) {
            return redirect('/product');
        }
        $this->data['css'] = array('signin.css');
        return view('user.login', $this->data);
    }
    
    public function authenticate(userLogin $userLogin)
    {
        $this->data['title'] = "Login";

        $user = AuthModel::where('email', $userLogin['email'])->first();

        if (!$user || !Hash::check($userLogin['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = Str::random(60);
        Session::put('user', $user);  // <- set session
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => $user,
            'redirect' => route('product')
        ], 201);
    }

 
    public function create()
    {
        if (Session::has('user')) {
            return redirect('/product');
        }
        $this->data['title'] = "Register";
        $this->data['css'] = array('signin.css');
        return view('user.register', $this->data);
    }

    
    public function store(createUser $createUser)
    {
        $user = AuthModel::create([
            'name' => $createUser->name,
            'email' => $createUser->email,
            'password' => Hash::make($createUser->password),
        ]);
        $user = AuthModel::where('email', $createUser['email'])->first();
        Session::put('user', $user);  // <- set session
        return response()->json([
            'success' => true,
            'message' => "User registered successfully",
            'redirect' => route('product')
        ], 201
        );
    }

    public function logout()
    {
        // Destroy the entire session
        Session::flush();
        // Optionally, you can revoke the token via API call here
        return redirect('/product')->with('message', 'You have been logged out.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
