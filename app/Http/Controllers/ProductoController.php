<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
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

    public function getProductos($idUser)
    {
        $persona = User::find($idUser); //TODO armar logueo
        $duenio = Duenio::find($persona -> id); //TODO armar logueo
        $productos = Producto::where('duenio_id',$duenio -> id)->get(); //TODO armar logueo
        return $productos;
    }

    public function addProducto(Request $request, $idUser)
    {
        //$user = $this->checkLogIn($request['token']);
        $cliente = Cliente::find($idUser); //TODO armar logueo
        $empleado = Empleado::first();
        if($cliente) {
            $producto = Producto::create([
                'fecha' => date('Y-m-d'),
                'descripcionCatalogo' => $request['descripcionCatalogo'],
                'descripcionCompleta' => $request['descripcionCompleta'],    
                'revisor_id' => $empleado->id,
                'duenio_id' => $cliente->id        
            ]);
            $duenio = Duenio::create([   
                'persona_id' => $cliente->id,
                'verificador' => $empleado->id        
            ]);
            return $producto;
        } else {
            return response()->json(['error' => 'Forbidden'], 403);
        }
    }

    public function disponibilizarProducto($id)
    {
        $producto = Producto::find($id);
        $producto->disponible = 'si';
        $producto->save();
        return $producto;
    }

    public function rechazarProducto($id)
    {
        $producto = Producto::find($id);
        $producto->disponible = 'rechazado';
        $producto->save();
        return $producto;
    }
}