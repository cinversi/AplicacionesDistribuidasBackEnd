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
use App\Models\Subastadore;
use App\Models\Empleado;

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
        $subastas = Subasta::where('estado','abierta')->get();
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
        $subastas = Subasta::where('estado','abierta')->whereIn('categoria',$categorias[$cliente->categoria])->get();
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

    public function addSubasta(Request $request)
    {
        $subastador = Subastadore::first();
        $empleado = Empleado::first();
        $item_catalogo = ItemsCatalogo::where('id',$request['item_id'])->first();
        $subasta = Subasta::create([
            'ubicacion' => $request['ubicacion'],
            'fecha' => $request['fecha'],    
            'horaInicio' => $request['horaInicio'],    
            'horaFin' => $request['horaFin'],    
            'estado' => $request['estado'],  
            'capacidadAsistentes' => $request['capacidadAsistentes'],
            'tieneDeposito' => $request['tieneDeposito'],
            'seguridadPropia' => $request['seguridadPropia'],
            'categoria' => $request['categoria'],
            'subastador_id' => $subastador->id        
        ]);
        $catalogo = Catalogo::create([
            'subasta_id' => $subasta->id,
            'responsable_id' => $empleado->id,
            'descripcion' => $request['descripcion']
        ]);
        $item_catalogo->catalogo_id = $catalogo->id;
        $item_catalogo->producto_id = $request['producto_id'];
        $item_catalogo->save();
        return $subasta;
    }

    public function cerrarSubasta(Request $request)
    {
        //Cambiar el estado de la subasta
        $subasta = Subasta::find($request['id']);
        $subasta->estado = 'cerrada';
        $subasta->save();

        //Cambiar el estado de los clientes
        DB::table('Asistentes')->where('subasta_id',$subasta->id)->update(['participando' => 0]);
        return;
    }

    public function abandonarSubasta(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        if($cliente) {
            $asistente = Asistente::where('cliente_id',$cliente->id)->where('subasta_id',$request['subasta_id'])->first();
            if($asistente){
                $asistente->participando = 0;
                $asistente->save();
            }
        }
        return null;
    }
}
