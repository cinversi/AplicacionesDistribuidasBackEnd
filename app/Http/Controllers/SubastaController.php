<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subasta;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Asistente;
use App\Models\Catalogo;
use App\Models\ItemsCatalogo;
use App\Models\Foto;

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

    // public function getAllSubastas()
    // {
    //     return Subasta::all();
    // }

    public function getAllSubastas()
    {
        $data = [];
        $subastas = Subasta::with('catalogo')->get();
        foreach ($subastas as $subasta){
            $catalogo = $subasta->catalogo;
            $itemsCatalogo = $catalogo->items;
            foreach($itemsCatalogo as $item){
                $item->producto->fotos;
            }
            $aux=[
                'id' => $subasta->id,
                'categoria' => $subasta->categoria,
                'fecha'=>$subasta->fecha,
                'horaInicio'=>$subasta->horaInicio,
                'horaFin'=>$subasta->horaFin,
                'moneda'=>$subasta->moneda,
                'descripcion' => $catalogo->descripcion,
                'items'=>$itemsCatalogo   
            ];
            array_push($data,$aux);
        }
        return $data;
    }

    public function getAllCategoriaSubastas(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        $categorias = [
            'PLATINO'=>['COMUN','ESPECIAL','PLATA','ORO','PLATINO'],
            'ORO'=>['COMUN','ESPECIAL','PLATA','ORO'],
            'PLATA'=>['COMUN','ESPECIAL','PLATA'],
            'ESPECIAL'=>['COMUN','ESPECIAL'],
            'COMUN'=>['COMUN']
        ];
        $data = [];
        $subastas = Subasta::whereIn('categoria',$categorias[$cliente->categoria])->get();
        foreach ($subastas as $subasta){
            $catalogo = $subasta->catalogo;
            $itemsCatalogo = $catalogo->items;
            foreach($itemsCatalogo as $item){
                $item->producto->fotos;
            }
            $aux=[
                'id' => $subasta->id,
                'categoria' => $subasta->categoria,
                'fecha'=>$subasta->fecha,
                'horaInicio'=>$subasta->horaInicio,
                'horaFin'=>$subasta->horaFin,
                'moneda'=>$subasta->moneda,
                'descripcion' => $catalogo->descripcion,
                'items'=>$itemsCatalogo   
            ];
            array_push($data,$aux);
        }
        return $data;
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
