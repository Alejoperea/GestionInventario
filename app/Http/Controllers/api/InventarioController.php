<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inventarios = Inventario::all();
        return json_encode( ['inventarios' => $inventarios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $inventario = new Inventario();

        $inventario -> producto_id  = $request -> producto_id ;
        $inventario -> proveedor_id   = $request -> proveedor_id  ;
        $inventario -> cantidad = $request-> cantidad;
        $inventario->save();

        return json_encode(['inventario' => $inventario]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $inventario = Inventario::find($id);

        return json_encode(['inventario'=> $inventario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $inventario = Inventario::find($id);
        $inventario -> producto_id = $request -> producto_id;
        $inventario -> proveedor_id = $request-> proveedor_id;
        $inventario -> cantidad = $request-> cantidad;
        $inventario ->  save();

        $inventario = DB::table('inventarios')
        ->orderBy('nombre')
        ->get();
        return json_encode (['inventario' => $inventario]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $inventario = Inventario::find($id);
        $inventario->delete();

        $inventario = DB::table('inventarios')
        ->orderBy('nombre')
        ->get();

        return json_encode (['inventario' => $inventario]);
    }
}
