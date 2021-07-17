<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemsCatalogo;

class ItemsCatalogoController extends Controller
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
    
    public function getItemsCatalogo($idCatalogo)
    {
        $itemscatalogo = ItemsCatalogo::all()->where('catalogo_id',$idCatalogo); //TODO armar logueo
        return $itemscatalogo;
    }

    public function getItemsCatalogoProducto(Request $request)
    {
        $itemCatalogo = ItemsCatalogo::where('producto_id',$request['producto_id'])->first();
        return $itemCatalogo;
    }

    public function addItemsCatalogo(Request $request)
    {
        $items = ItemsCatalogo::create([
            'precioBase' => $request['precioBase'],    
            'comision' => $request['comision'],
            'subastado' => $request['subastado'],    
            'catalogo_id' => $request['catalogo_id'],
            'producto_id' => $request['producto_id']        
        ]);
        return $items;
    }
}
