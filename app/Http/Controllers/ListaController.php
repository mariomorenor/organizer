<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Rules\ComprobarSiExiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        if($request->ajax()){
            
            $lista = DB::table('registros')->where('fecha',$request->fecha)->get();
            return response()->json([
                'totalRows'=>count($lista),
                'rows'=>$lista
            ]);
        }
        return view('listas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
  
        if ($request->ajax()) {
            
            $clientes = Cliente::orderBy('posicion','asc')->where('mostrar',true)->get();
            return response()->json([
                'totalRows' => count($clientes),
                'totalNotFiltered' => count($clientes),
                'rows' => $clientes
            ]);
        }
        return view('listas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $codigos_existentes  =  $this->Comprobar_Si_Existen_Codigos($request->codigo, $request->fecha);
      
        if (count($codigos_existentes) == 0) {
            $numClientes = $request->codigo;
            for ($i = 0; $i < count($numClientes); $i++) {
                DB::table('registros')->insert([
                    'cliente_codigo' => $request->codigo[$i],
                    'cantidad' => $request->cantidad[$i],
                    'descripcion' => $request->observacion[$i],
                    'fecha' => $request->fecha,
                ]);
            }
            
        }else{
            return response()->json($codigos_existentes,404);
        }
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

 
    public function update( $codigo, Request $request)
    {  
        DB::table('registros')->where('cliente_codigo',$codigo)
        ->where('fecha',$request->fecha)
        ->update(['cantidad'=>$request->cantidad,'descripcion'=>$request->descripcion]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {   
        
        intval($request->todos) == 0 ?
        DB::table('registros')->where('cliente_codigo',$id)->where('fecha',$request->fecha)->delete():
        DB::table('registros')->whereIn('cliente_codigo',$request->codigos)->where('fecha',$request->fecha)->delete();
         
        
         
    }

    public function Comprobar_Si_Existen_Codigos($valores, $fecha)
    {
        $codigos_que_existen = [];
     
        $cont = 0;
        foreach ($valores as $codigo) {
           $exist = DB::table('registros')->where('cliente_codigo', 'like', $codigo)->where('fecha', $fecha)->exists();
            if ($exist) {
                $codigos_que_existen[$cont] = $codigo;
                $cont++;
            }
        }
        return $codigos_que_existen;
    }

    public function obtener_Codigos(Request $request)
    {   

        if ( $request->has('fecha_Inicio')) {
    
                return DB::table('registros')
                ->join('clientes','clientes.codigo','like','registros.cliente_codigo')
                ->whereBetween('fecha',[$request->fecha_Inicio,$request->fecha_Fin])
                ->orderBy('posicion','asc')
                ->get();
          
        }else if($request->codigo == null){
            return  DB::table('registros')
            ->join('clientes','clientes.codigo','like','registros.cliente_codigo')
            ->where('fecha',$request->fecha)
            ->orderBy('posicion','asc')
            ->get();
        }
    }
}
