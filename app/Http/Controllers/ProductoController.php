<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Duenio;
use Carbon\Carbon;

class ProductoController extends Controller
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

    public function getAllProductos()
    {
        $producto = Producto::all();
        return $producto;
    }

    public function getProductos(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $duenio = Duenio::where('persona_id',$user->persona_id)->first();
        $productos = Producto::where('duenio_id',$duenio -> id)->get(); 
        $data = [];
        foreach ($productos as $producto){
            $aux=[
                'id' => $producto->id,
                'artista_obra' => $producto->artista_obra,
                'cantidad'=>$producto->cantidad,
                'descripcionCatalogo'=>$producto->descripcionCatalogo,
                'descripcionCompleta'=>$producto->descripcionCompleta,
                'duenio_id'=>$producto->duenio_id,
                'fecha' => $producto->fecha,
                'fecha_obra'=>$producto->fecha_obra,
                'historia_obra'=>$producto->historia_obra,
                'disponible'=>$producto->disponible,
                'fotos'=>$producto->fotos
            ];
            array_push($data,$aux);
        }
        return $data;
    }

    public function addProducto(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $empleado = Empleado::first();
        $duenioCreado = Duenio::where('persona_id',$user->persona_id)->first();
        if($duenioCreado==null){
            if($user) {
                $duenio = Duenio::create([   
                    'persona_id' => $user->persona_id,
                    'verificador' => $empleado->id        
                ]);
            } else {
                return response()->json(['error' => 'Forbidden'], 403);
            }
            $duenio = Duenio::where('persona_id',$user->persona_id)->first();
            if($duenio){
                $producto = Producto::create([
                    'fecha' => date('Y-m-d'),
                    'descripcionCatalogo' => $request['descripcionCatalogo'],    
                    'descripcionCompleta' => $request['descripcionCompleta'],    
                    'cantidad' => $request['cantidad'],    
                    'artista_obra' => $request['artista_obra'],  
                    'fecha_obra' => $request['fecha_obra'],
                    'historia_obra' => $request['historia_obra'],
                    'revisor_id' => $empleado->id,
                    'duenio_id' => $duenio->id        
                ]);
                return $producto;
            }
        }else{
            $producto = Producto::create([
                'fecha' => date('Y-m-d'),
                'descripcionCatalogo' => $request['descripcionCatalogo'],    
                'descripcionCompleta' => $request['descripcionCompleta'],    
                'cantidad' => $request['cantidad'],    
                'artista_obra' => $request['artista_obra'],  
                'fecha_obra' => $request['fecha_obra'],
                'historia_obra' => $request['historia_obra'],
                'revisor_id' => $empleado->id,
                'duenio_id' => $duenioCreado->id        
            ]);
            return $producto;
        }
    }

    public function aceptarProducto(Request $request)
    {
        $producto = Producto::find($request['id']);
        $producto->disponible = 'si';
        $producto->save();
        return $producto;
    }

    public function rechazarProducto(Request $request)
    {
        $producto = Producto::find($request['id']);
        $producto->disponible = 'rechazado';
        $producto->save();
        return $producto;
    }
}