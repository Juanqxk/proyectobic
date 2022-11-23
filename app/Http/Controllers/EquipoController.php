<?php

namespace App\Http\Controllers;

use App\Models\equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //traer todos los elementos de la tabla equipos al index
        $Equipos = equipo::where('estado', 'like', 1)->paginate();
        return view('admin/ver_equipo', compact('Equipos'));
    }

    public function index2(Request $request)
    {
        //traer todos los elementos de la tabla equipos al index
        $Equipos = equipo::where('estado', 'like', 1)->paginate();
        return view('cliente/ver_equipo_cliente', compact('Equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //retornar la vista del formulario de equipos
        return view('admin/agregar_equipo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $NewEquipo = new equipo;

        if ($request->hasFile('img_equipo')) {
            $file = $request->file('img_equipo');
            $destinationPath = 'img/equipo/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $NewEquipo->img_equipo = $destinationPath . $filename;
        }


        $NewEquipo->nombre = $request->input('nombre');
        $NewEquipo->descripcion = $request->input('descripcion');
        $NewEquipo->save();
        return redirect()->route('lista.equipo');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $equipos = equipo::findOrFail($id);
        $equipos->nombre = $request->input('nombre_update');
        $equipos->descripcion = $request->input('desc_update');
        $equipos->save();
        return redirect()->route('lista.equipo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}