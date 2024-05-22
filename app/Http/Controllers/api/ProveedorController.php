<?php

namespace App\Http\Controllers\api;
use App\Models\Proveedor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $proveedores = Proveedor::all();
        return json_encode( ['proveedores' => $proveedores]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $proveedor = new Proveedor();

        $proveedor -> nombre = $request -> nombre;
        $proveedor -> contacto = $request-> contacto;
        $proveedor->save();

        return json_encode(['proveedor' => $proveedor]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $proveedor = Proveedor::find($id);

        return json_encode(['proveedor'=> $proveedor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $proveedor = Proveedor::find($id);
        $proveedor -> nombre = $request -> nombre;
        $proveedor -> contacto = $request-> contacto;
        $proveedor ->  save();

        $proveedor = DB::table('proveedores')
        ->orderBy('nombre')
        ->get();
        return json_encode (['proveedor' => $proveedor]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $proveedor = Proveedor::find($id);
        $proveedor->delete();

        $proveedor = DB::table('proveedores')
        ->orderBy('nombre')
        ->get();

        return json_encode (['proveedor' => $proveedor]);
    }
}
