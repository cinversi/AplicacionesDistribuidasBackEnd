<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pujo;
use App\Models\ItemsCatalogo;
use App\Models\Producto;
use App\Models\User;
use App\Models\Asistente;

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

    public function addPuja(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        $item = ItemsCatalogo::where('id',$request['item_id'])->first();
        $producto = Producto::find($item->producto_id);
        $asistente = Asistente::where(['id'=>$request['asistente_id'],'subasta_id'=>$request['subasta_id']])->first();
        if($cliente) {
            $pujo = Pujo::create([
                'asistente_id' => $asistente->id,
                'item_id' => $item->id
            ]);
            $registrosubasta = RegistroDeSubasta::create([
                'importe' => $request['importe'], 
                'comision' => $request['comision'], 
                'subasta_id' => $request['subasta_id'],
                'duenio_id' => $producto->duenio_id,
                'producto_id' => $item->producto_id,
                'cliente_id' => $cliente->id,
            ]);
        } else {
            return response()->json(['error' => 'Forbidden'], 403);
        }
    }

}