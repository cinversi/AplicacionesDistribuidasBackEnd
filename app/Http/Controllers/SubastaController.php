<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subasta;
use App\Models\Cliente;
use App\Models\Asistente;
use DB;

class SubastaController extends Controller
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

    public function getAllSubastas()
    {
        return Subasta::all();
    }

    public function getAllCategoriaSubastas($idUser)
    {
        $user = Cliente::find($idUser); //TODO armar logueo
        $categorias = [
            'platino'=>['comun','especial','plata','oro','platino'],
            'oro'=>['comun','especial','plata','oro'],
            'plata'=>['comun','especial','plata'],
            'especial'=>['comun','especial'],
            'comun'=>['comun']
        ];
        return Subasta::whereIn('categoria',$categorias[$user->categoria])->get();
    }

    public function cerrarSubasta($id)
    {
        //Cambiar el estado de la subasta
        $subasta = Subasta::find($id);
        $subasta->estado = 'cerrada';
        $subasta->save();

        //Cambiar el estado de los clientes
        DB::table('Asistentes')->where('subasta_id',$subasta->id)->update(['numeroPostor' => 0]);
        return;
    }

}
