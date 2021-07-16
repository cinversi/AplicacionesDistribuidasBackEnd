<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Cliente;
use App\Models\Persona;
use App\Models\Empleado;
use App\Models\Paise;
use App\Models\User;

class ClienteController extends Controller
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

    public function addCliente(Request $request)
    {
        $fechamax = Persona::max('created_at');
        $persona = Persona::where('created_at',$fechamax)->first();
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
            // return response()->json(['error' => 'Forbidden'], 403);
        }
    }

    public function admitirCliente($id)
    {
        $cliente = Cliente::find($id);
        $cliente->admitido = 'si';
        $cliente->save();
        return "ok";
    }

    public function getCliente(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        return $cliente;
    }
}