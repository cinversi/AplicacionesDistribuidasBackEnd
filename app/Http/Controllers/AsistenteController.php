<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Subasta;
use App\Models\User;
use App\Models\Asistente;
use App\Models\Pujo;
use App\Models\ItemsCatalogo;
use App\Models\Producto;
use App\Models\RegistroDeSubasta;

class AsistenteController extends Controller
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

    public function addAsistente(Request $request)       
    {
        $user = User::where('user_id',$request['user_id'])->first();
        $cliente = Cliente::where('persona_id',$user->persona_id)->first();
        $subasta_id = $request['subasta_id'];
        $asistenteCreado = Asistente::where('cliente_id',$cliente->id)->where('subasta_id',$subasta_id)->first();
        $asistenteGeneral = Asistente::where('cliente_id',$cliente->id)->where('participando','!=',0)->where('subasta_id','!=',$subasta_id)->first();
        $item = ItemsCatalogo::where('id',$request['item_id'])->first();
        $producto = Producto::find($item->producto_id);
        if($cliente){
            if($asistenteCreado==null && $asistenteGeneral==null) {
                $asistente = Asistente::create([
                    'numeroPostor' => rand(1,100),   
                    'cliente_id' => $cliente->id,
                    'subasta_id' => $subasta_id,
                    'participando' =>  $subasta_id 
                ]);
            }else{
                $asistente = $asistenteCreado;
            }
        }else {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        if($asistente && $asistenteGeneral==null) {
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
            return "EnOtraSubasta";
        }
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
