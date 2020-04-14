<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Pago;
use Carbon\Carbon;
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
    public function create(Request $request)
    {
        $listado_codigos = Cliente::orderBy('posicion','asc')->get('codigo');
      
        return view('facturacion.create')->with(['listado_codigos'=>$listado_codigos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    for ($i=0; $i < count($request->codigo) ; $i++) { 
       
        DB::transaction(function() use ($request, $i){

            $hora =  Carbon::now();
            $saldo_actual = Pago::where('codigo','like',$request->codigo[$i])->orderBy('fecha','desc')->first();
            
            $saldo_actual = ($saldo_actual->saldo - $request->dinero[$i]) < 0 ? 0: ($saldo_actual->saldo - $request->dinero[$i]) ;
            $registro_pago = new Pago;

            $registro_pago->codigo = $request->codigo[$i];
            $registro_pago->tipo_transaccion = 'Pagado';
            // $registro_pago->fecha = $request->fecha[$i];
            $registro_pago->fecha = Carbon::parse($request->fecha[$i].' '.$hora->toTimeString())->toDateTimeString();
            $registro_pago->cantidad = $request->dinero[$i];
            $registro_pago->saldo = $saldo_actual;
            $registro_pago->descripcion = $request->descripcion[$i];
            
            $registro_pago->save();


        });

    }
        return redirect()->route('pagos.index');
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

    public function comprobarSaldo(Cliente $cliente)
    {
        
        return  Pago::where('codigo',$cliente->codigo)->orderBy('fecha','desc')->first();
    }
}
