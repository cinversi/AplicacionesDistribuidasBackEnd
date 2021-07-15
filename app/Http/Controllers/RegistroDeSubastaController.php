<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroDeSubasta;

class RegistroDeSubastaController extends Controller
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

    public function getUltimaPuja(Request $request)
    {
        $fechamax = RegistroDeSubasta::max('created_at');
        $registroSubasta = RegistroDeSubasta::where('created_at',$fechamax)->where('producto_id',$request['producto_id']);
        return $registroSubasta;
    }

    public function getGanadorSubasta($id)
    {
        //Cambiar el estado de la subasta
        //$subasta = RegistroDeSubastas::find($id);
        $importemaximo = RegistroDeSubasta::where('subasta_id',$id)->max('importe');
        //$registrosubasta = RegistroDeSubasta::where('subasta_id',$id)->get();
        $ganador = RegistroDeSubasta::where('subasta_id',$id)->where('importe',$importemaximo)->get('cliente_id');
        return $ganador;
    }    
}
