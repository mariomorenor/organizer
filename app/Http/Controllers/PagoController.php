<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $total_registros =  DB::table('clientes')
            ->join('pagos','pagos.codigo','like','clientes.codigo')
            ->distinct()
            ->orderBy('clientes.posicion','asc')
            ->get(['clientes.codigo','clientes.posicion']);
    
            $registros = [];
    
            $cont= 0;
    
            foreach ($total_registros as $codigos) {
                $registros[$cont] = Pago::where('codigo','like',$codigos->codigo)->orderBy('fecha','desc')->first();
                $cont++; 
            }
    
            return response()->json([
                'rows'=>$registros
            ]);
        }
        return view('facturacion.index');
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
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $codigo)
    {
       
 
        if ($request->ajax()) {
            // $registro = Pago::where('codigo','like',$codigo)->orderBy(['fecha','desc'])->get();
            if($request->tipo_transaccion === 'all'){
                $registro = Pago::where('codigo','like',$codigo)->orderBy('tipo_transaccion','desc')->orderBy('fecha','desc')->get();
            }else{
                $registro = Pago::where('codigo','like',$codigo)->where('tipo_transaccion',$request->tipo_transaccion)->orderBy('tipo_transaccion','desc')->orderBy('fecha','desc')->get();
            }
            return response()->json([
                'totalRows'=> count($registro),
                'rows'=>$registro,
            ]);
        }
        return view('facturacion.show')->with(['codigo'=>$codigo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
