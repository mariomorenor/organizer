<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if($request->ajax()){
            $clientes = Cliente::orderBy('posicion','asc')->get();
            return response()->json([
                'totalRows'=>count($clientes),
                'rows'=> $clientes
            ]);
        }
        return view('clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $nuevo_Cliente = new Cliente;
        $nuevo_Cliente->fill($request->all());

        $nuevo_Cliente = $this->cambiar_Posicion($request, $nuevo_Cliente);
        $nuevo_Cliente->save();
        return redirect()->back()->with('status','Operación Realizada con Éxito');
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {   
        $cliente_Anterior = ($cliente->posicion - 1)== 0 ? new Cliente:Cliente::where('posicion',$cliente->posicion-1)->first(); 
        $cliente->posicion = $cliente_Anterior->codigo;
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
 
        $cliente = $this->cambiar_Posicion($request, $cliente);
        $cliente->update();
        return redirect()->back()->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {   
        if(count($request->codigos)> 0 ){
        $cliente = Cliente::findMany($request->codigos);
        for ($i=0; $i < count($cliente) ; $i++) { 
            // $cliente[$i]->forceDelete();
            $cliente[$i]->Delete();
        }
    }else{
        return response()->json('',404);       
        }
        
    }

    public function cambiar_Posicion($request, $cliente)
    {
        $pos = $cliente->posicion == null? 1:$cliente->posicion;
        
        $cliente->fill($request->all());
        $cliente->mostrar = intval($request->mostrar);

        if($request->posicion == null){
            $existen_registros = Cliente::exists();
            $cantidad_registros = Cliente::count();
           
            if( !$existen_registros | $cantidad_registros == 1){
                
                $cliente->posicion = 1;
            }else{
                $listado = Cliente::where('posicion','>=',$pos)->where('codigo','not like',$cliente->codigo)->orderBy('posicion','asc')->get();
                for ($i=0; $i < count($listado) ; $i++) { 
                    $listado[$i]->update(['posicion'=>$pos]);
                    $pos++;
                }
                $last = Cliente::orderBy('posicion','desc')->first();
              
                $cliente->posicion = $last->posicion + 1;
            }

        }else{
       
            $codigo_anterior = Cliente::where('codigo','like',$request->posicion)->first();
            $listado = Cliente::where('posicion','>',$codigo_anterior->posicion)->where('codigo','not like',$cliente->codigo)->orderBy('posicion','asc')->get();
        
            $nueva_posicion_incial = $codigo_anterior->posicion+1;
           
            $cliente->posicion = $nueva_posicion_incial;
            for ($i=0; $i < count($listado) ; $i++) { 
                $nueva_posicion_incial++;
                    $listado[$i]->update(['posicion'=>$nueva_posicion_incial]);
            }
           
        }


        return $cliente;
    }
public function comprobarCliente(Cliente $cliente)
{
    return $cliente;
}
}
