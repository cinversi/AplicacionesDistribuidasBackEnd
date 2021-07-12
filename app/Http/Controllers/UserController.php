<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function addUser(Request $request)
    {
        $fechamax = Persona::max('created_at');
        $persona = Persona::where('created_at',$fechamax)->first();
        if($persona) {
            $user = User::create([
                'name' => $persona->nombre,
                'email' => $request['email'],
                'persona_id' => $persona->id,
                'password' => rand(10000,90000)
            ]);
            $user = User::where('email',$request->email)->first();
            $user->token = $user->password;
            $user->save();
            return $user;
        } else {
            // return response()->json(['error' => 'Forbidden'], 403);
        }
    }

    public function generatePassword(Request $request)
        {
            $user = User::where('email',$request['email'])->first();
            if($user)
            {
                $user->update(['password' => $request['password']]);
                $user->save();
            }
            else
            {
                return ["error"=>"Email o password incorrecta"];
            }
            return $user;
        }
    
    // public function login(Request $request){
    //     $user = User::where('email',$request->email)->first();
    //     if(!$user || $request->password!=$user->password)
    //     {
    //         return response()->json(['error' => 'Forbidden'],403);
    //     }
    //     else if ($user && $request->password==$user->password && $user->password==$user->token)
    //     {
    //         return response()->json('generatepassword');
    //     }
    //     else if ($user && $request->password==$user->password && $user->password!=$user->token)
    //     {
    //         $user = Auth::user();
    //         return response()->json('login');
    //     } 
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, true)) {
            // Authentireturcation passed...
            return response()->json([
                'success' => 'success',
                200]);
        } else {
            return abort(403,'Login');
        }
    }

}