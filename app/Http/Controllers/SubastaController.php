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
use App\Models\Producto;
use App\Models\RegistroDeSubasta;

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
        $item_catalogo = ItemsCatalogo::where('producto_id',$request['producto_id'])->first();
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


    public function getSubastaProducto(Request $request)
    {
        $producto = Producto::where('id',$request['id'])->first();
        $items = ItemsCatalogo::where('producto_id',$producto->id)->first();
        $catalogo = Catalogo::where('id',[$items->catalogo_id])->first();
        if($producto->disponible == 'si') {
            $subasta = Subasta::where('id',$catalogo->subasta_id)->first();
            return $subasta;
        }
        return null;
    }

    public function getGanadorSubasta(Request $request)
    {
        $user = User::where('user_id',$request['id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        $ultimaSubasta = Subasta::whereExists(function ($query) use ($cliente){
                                        $query->select(DB::raw(1))
                                        ->from('registro_de_subastas AS rs')
                                        ->whereRaw('rs.subasta_id = subastas.id')
                                        ->where('rs.cliente_id',$cliente->id);
                                    })->orderBy('fecha','desc')->orderBy('horaFin','desc')->first();
        if($ultimaSubasta->estado=="cerrada"){
            $maximport = RegistroDeSubastas::where('subasta_id',$ultimaSubasta->id)->orderBy('importe','desc')->first();
                    if ($maximport->cliente_id==$cliente->id){
                        $data = [
                            'descripcion' => $ultimaSubasta->catalogo->descripcion,
                            'estado' => 'Ganaste'];
                        return $data;
                    }
                    else{
                        $data = [
                            'descripcion' => $ultimaSubasta->catalogo->descripcion,
                            'estado' => 'No Ganaste'];
                        return $data;
                    }
        }else{
            $data = [
                'descripcion' => $ultimaSubasta->catalogo->descripcion,
                'estado' => 'Participando'];
            return $data;
        }
    }

    public function getSubastaDeCliente(Request $request)
    {
        $user = User::where('user_id',$request['id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        $subastaParticipo = Subasta::whereExists(function ($query) use ($cliente){
                                        $query->select(DB::raw(1))
                                        ->from('registro_de_subastas AS rs')
                                        ->whereRaw('rs.subasta_id = subastas.id')
                                        ->where('rs.cliente_id',$cliente->id);
                                    })->get();
        $cantidadparticipaciones =count($subastaParticipo);
        $pujasganadas = RegistroDeSubasta::where('cliente_id',$cliente->id)->
                            whereNotExists(function ($query) use ($cliente){
                                $query->select(DB::raw(1))
                                ->from('registro_de_subastas AS rs')
                                ->whereRaw('rs.subasta_id = registro_de_subastas.subasta_id')
                                ->where('rs.importe','>',(DB::raw('registro_de_subastas.importe')));
                            })->get();
        $subastasganadas = Subasta::whereIn('id',$pujasganadas->pluck('subasta_id'))->get();
        $cantidadsubastasganadas = count($subastasganadas);
        $importegastado = $pujasganadas->sum('importe');
        $data = [
            'cantidadparticipaciones' => $cantidadparticipaciones,
            'cantidadsubastasganadas' => $cantidadsubastasganadas,
            'importegastado' => $importegastado];
        return $data;
    }
}
