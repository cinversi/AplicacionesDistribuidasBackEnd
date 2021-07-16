<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Paise;
use App\Models\Cliente;

class PersonaController extends Controller
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

    public function addPersona(Request $request)
    {
        $persona = Persona::create([
            'documento' => $request['documento'],
            'nombre' => $request['nombre'],    
            'direccion' => $request['direccion']
        ]);
        if($persona) {
            $user = User::create([
                'name' => rand(1,100),
                'email' => $request['email'],
                'persona_id' => $persona->id,
                'password' => Hash::make(rand(1,100)),
                'user_id' => $request['user_id']
            ]);
        } else {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        $persona = Persona::where('id',$persona->id)->first();
        $empleado = Empleado::first();
        $pais = Paise::first();
        if($persona) {
            $cliente = Cliente::create([
                'persona_id' => $persona->id,
                'empleado_id' => $empleado->id,
                'numeroPais_id' => $pais->id,
                'categoria' => $request['categoria']
            ]);
            return $cliente;
        } else {
            return response()->json(['error' => 'Forbidden'], 403);
        }
    }

    public function getPersona(Request $request)
    {
        $user = User::where('email',$request['email'])->first();
        $persona = Persona::where('id',$user->persona_id)->first();
        return $persona;
    }
}