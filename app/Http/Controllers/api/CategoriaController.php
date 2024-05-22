<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return json_encode( ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $categoria = new Categoria();

        $categoria -> nombre = $request -> nombre;
        $categoria -> descripcion = $request-> descripcion;
        $categoria->save();

        return json_encode(['categoria' => $categoria]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);

        return json_encode(['categoria'=> $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $categoria = Categoria::find($id);
        $categoria -> nombre = $request -> nombre;
        $categoria -> descripcion = $request-> descripcion;
        $categoria ->  save();

        $categoria = DB::table('categorias')
        ->orderBy('nombre')
        ->get();
        return json_encode (['categoria' => $categoria]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categoria = Categoria::find($id);
        $categoria->delete();

        $categoria = DB::table('categorias')
        ->orderBy('nombre')
        ->get();

        return json_encode (['categoria' => $categoria,'success' =>true]);
    }
}
