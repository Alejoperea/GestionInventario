<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Realizamos un join con las tablas productos y proveedores para obtener los nombres
        $inventarios = DB::table('inventarios')
            ->join('productos', 'inventarios.producto_id', '=', 'productos.id')
            ->join('proveedores', 'inventarios.proveedor_id', '=', 'proveedores.id')
            ->select('inventarios.*', 'productos.nombre as producto_nombre', 'proveedores.nombre as proveedor_nombre')
            ->get();
        
        return json_encode(['inventarios' => $inventarios], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validamos los datos de entrada
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'cantidad' => 'required|integer'
        ]);

        // Creamos un nuevo inventario
        $inventario = new Inventario();
        $inventario->producto_id = $request->producto_id;
        $inventario->proveedor_id = $request->proveedor_id;
        $inventario->cantidad = $request->cantidad;
        $inventario->save();

        return json_encode(['inventario' => $inventario]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscamos el inventario por ID y realizamos el join para obtener los nombres
        $inventario = DB::table('inventarios')
            ->join('productos', 'inventarios.producto_id', '=', 'productos.id')
            ->join('proveedores', 'inventarios.proveedor_id', '=', 'proveedores.id')
            ->select('inventarios.*', 'productos.nombre as producto_nombre', 'proveedores.nombre as proveedor_nombre')
            ->where('inventarios.id', $id)
            ->first();

        return json_encode(['inventario' => $inventario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validamos los datos de entrada
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'cantidad' => 'required|integer'
        ]);

        // Actualizamos el inventario existente
        $inventario = Inventario::find($id);
        if ($inventario) {
            $inventario->producto_id = $request->producto_id;
            $inventario->proveedor_id = $request->proveedor_id;
            $inventario->cantidad = $request->cantidad;
            $inventario->save();

            return json_encode(['inventario' => $inventario]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminamos el inventario por ID
        $inventario = Inventario::find($id);
        if ($inventario) {
            $inventario->delete();
        }

        return json_encode (['inventario' => $inventario]);
    }
}
