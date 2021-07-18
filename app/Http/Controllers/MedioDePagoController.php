<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediosDePago;
use App\Models\Cliente;
use App\Models\User;

class MedioDePagoController extends Controller
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

    public function addMedioPago(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        $existemedio = MediosDePago::where('cliente_id',$cliente->id)->first();
        if($cliente && $existemedio==null) {
            $mediopago = MediosDePago::create([
                'numero' => $request['numero'],
                'expiracion' => $request['expiracion'],    
                'cvc' => $request['cvc'],
                'nombre' => $request['nombre'],
                'codigoPostal' => $request['codigoPostal'],
                'tipo' => $request['tipo'],
                'default' => 1,
                'cliente_id' => $cliente->id
            ]);
            return $mediopago;
        } elseif($cliente && $existemedio==null) {
            $mediopago = MediosDePago::create([
                'numero' => $request['numero'],
                'expiracion' => $request['expiracion'],    
                'cvc' => $request['cvc'],
                'nombre' => $request['nombre'],
                'codigoPostal' => $request['codigoPostal'],
                'tipo' => $request['tipo'],
                'cliente_id' => $cliente->id
            ]);
            return $mediopago;
        }
    }

    public function getMediosDePago(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        if($cliente){
            $MediosDePago = MediosDePago::where('cliente_id',$cliente->id)->where('verificado','si')->get();
            return $MediosDePago;
        }
    }

    public function habilitarMedioDePago(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        if($cliente){
            $MediosDePago = MediosDePago::where('cliente_id',$cliente->id)->where('id',$request['mp_id'])->first();
            $MediosDePago->verificado = 'si';
            $MediosDePago->save();
            return $MediosDePago;
        }
    }

    public function rechazarMedioDePago(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        if($cliente){
            $MediosDePago = MediosDePago::where('cliente_id',$cliente->id)->where('id',$request['mp_id'])->first();
            $MediosDePago->verificado = 'rechazado';
            $MediosDePago->save();
            return $MediosDePago;
        }
    }

    public function defaultMedioDePago(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        $existemedio = MediosDePago::where('cliente_id',$cliente->id)->where('default',1)->first();
        if($cliente){
            $MediosDePago = MediosDePago::where('cliente_id',$cliente->id)->where('id',$request['mp_id'])->first();
            $MediosDePago->default = 1;
            $MediosDePago->save();
            $existemedio->default = 0;
            $existemedio->save();
            return $MediosDePago;
        }
    }

    public function eliminarMedioDePago(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        $existemedio = MediosDePago::where('cliente_id',$cliente->id)->get();
        if($cliente && count($existemedio)>1){
            $MediosDePago = MediosDePago::where('cliente_id',$cliente->id)->where('id',$request['mp_id'])->first();
            $MediosDePago->verificado = 'eliminado';
            $MediosDePago->save();
            return $MediosDePago;
        }
    }
}
