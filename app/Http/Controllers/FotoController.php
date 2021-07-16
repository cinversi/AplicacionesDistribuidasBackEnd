<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\User;
use App\Models\Producto;
use App\Models\Duenio;

class FotoController extends Controller
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

    public function addFoto(Request $request)
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $duenio = Duenio::where('persona_id',$user->persona_id)->first();
        if($duenio) {
            $fechamax = Producto::max('created_at');
            $producto = Producto::where('duenio_id',$duenio->id)->where('created_at',$fechamax)->first();
            if($producto) {
                $foto = Foto::create([
                    'foto' => $request['foto'],
                    'producto_id' => $producto->id
                ]);
                return $foto;
            }
        } else {
            return response()->json(['error' => 'Forbidden'], 403);
        }
    }
}