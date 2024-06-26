<?php

namespace App\Http\Controllers\api;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = DB::table('productos')
        ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombre as categoria_nombre')
        ->orderBy('id')
        ->get();
       
        return json_encode(['productos' => $productos], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id  = $request->categoria_id ;
        $producto->save();

        return json_encode(['producto' => $producto]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $producto = Producto::find($id);
        $categoria =DB::table('categorias')
        ->orderBy('nombre')
        ->get();

        return json_encode(['producto' => $producto, 'categoria' =>$categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();
    
        return json_encode(['producto'=>$producto]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $producto = Producto::find($id);
        $producto->delete();

        $producto = DB::table('productos')
        ->orderBy('nombre')
        ->get();

        return json_encode(['producto' => $producto]);
    }
}
