<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediosDePago;
use App\Models\Cliente;

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

    public function addMedioPago(Request $request, $idUser)
    {
        //$user = $this->checkLogIn($request['token']);
        $cliente = Cliente::find($idUser); //TODO armar logueo
        if($cliente) {
            $mediopago = MediosDePago::create([
                'cuentabancaria' => $request['cuentabancaria'],
                'numero' => $request['numero'],
                'expiracion' => $request['expiracion'],    
                'cvc' => $request['cvc'],
                'nombre' => $request['nombre'],
                'codigoPostal' => $request['codigoPostal'],
                'tipo' => $request['tipo'],
                'cliente_id' => $cliente->id
            ]);
            return $mediopago;
        } else {
            return response()->json(['error' => 'Forbidden'], 403);
        }
    }

    public function habilitarMedioDePago($id)
    {
        $MediosDePago = MediosDePago::find($id);
        $MediosDePago->verificado = 'si';
        $MediosDePago->save();
        return $MediosDePago;
    }

    public function rechazarMedioDePago($id)
    {
        $MediosDePago = MediosDePago::find($id);
        $MediosDePago->verificado = 'rechazado';
        $MediosDePago->save();
        return $MediosDePago;
    }
}
