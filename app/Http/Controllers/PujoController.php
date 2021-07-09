<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pujo;
use App\Models\ItemsCatalogo;
use App\Models\Producto;

class PujoController extends Controller
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

    public function addPuja(Request $request,$idUser,$idAsistente,$idSubasta,$idItem)
    {
        $cliente = Cliente::find($idUser); //TODO armar logueo
        $item = ItemsCatalogo::find($idItem); //TODO pasar iditem
        $producto = Producto::find($item->producto_id);
        //$user = $this->checkLogIn($request['token']); //TODO armar logueo
        if($cliente) {
            $pujo = Pujo::create([
                'asistente_id' => $idAsistente,
                'item_id' => $idItem
            ]);
            $registrosubasta = RegistroDeSubasta::create([
                'importe' => $request['importe'], //TODO agregar importe
                'comision' => $request['comision'], //TODO agregar comision
                'subasta_id' => $idSubasta,
                'duenio_id' => $producto->duenio_id,
                'producto_id' => $item->producto_id,
                'cliente_id' => $cliente->id,
            ]);
        } else {
            // return response()->json(['error' => 'Forbidden'], 403);
        }
    }
}