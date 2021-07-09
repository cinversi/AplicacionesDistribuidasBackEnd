<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Subasta;

class AsistenteController extends Controller
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

    public function addAsistente($idUser,$idSubasta)
    {
        $cliente = Cliente::find($idUser);
        //$user = $this->checkLogIn($request['token']); //TODO armar logueo
        if($cliente) {
            $asistente = Asistente::create([
                'numeroPostor' => rand(1,100),   
                'cliente_id' => $cliente->id,
                'subasta_id' => $idSubasta  
            ]);
            return $asistente;
        } else {
            // return response()->json(['error' => 'Forbidden'], 403);
        }
    }

    public function abandonarSubasta($idUser,$idSubasta)
    {
        $cliente = Cliente::find($idUser);
        //$user = $this->checkLogIn($request['token']); //TODO armar logueo
        if($cliente) {
            $asistente = Asistente::where('cliente_id',$cliente->id)->where('subasta_id',$idSubasta);
            $asistente->numeroPostor = 0;
            $asistente->save();
            return $asistente;
        } else {
            // return response()->json(['error' => 'Forbidden'], 403);
        }
    }
}
