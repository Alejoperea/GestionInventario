<?php

namespace App\Http\Controllers\api;
use App\Models\Transaccion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $transacciones = Transaccion::all();
        // return json_encode( ['transacciones' => $transacciones]);


        $transacciones = DB::table('transacciones')
        ->join('productos', 'transacciones.producto_id', '=', 'productos.id')
        ->select('transacciones.*', 'productos.nombre as producto_nombre')
        // ->orderBy('id')
        ->get();
       
        return json_encode(['transacciones' => $transacciones], 200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $transaccion = new Transaccion();

        $transaccion -> tipo = $request -> tipo;
        $transaccion -> producto_id  = $request -> producto_id ;
        $transaccion -> cantidad  = $request -> cantidad ;
        $transaccion -> fecha = $request-> fecha;
        $transaccion->save();

        return json_encode(['transaccion' => $transaccion]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $transaccion = Transaccion::find($id);

        return json_encode(['transaccion'=> $transaccion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $transaccion = Transaccion::find($id);
        $transaccion -> tipo = $request -> tipo;
        $transaccion -> producto_id = $request-> producto_id;
        $transaccion -> cantidad = $request-> cantidad;
        $transaccion -> fecha = $request-> fecha;
        $transaccion ->  save();

        $transaccion = DB::table('transacciones')
        // ->orderBy('nombre')
        ->get();
        return json_encode (['transaccion' => $transaccion]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $transaccion = Transaccion::find($id);
        $transaccion->delete();

        $transaccion = DB::table('transacciones')
        ->orderBy('nombre')
        ->get();

        return json_encode (['transaccion' => $transaccion]);
    }
}
