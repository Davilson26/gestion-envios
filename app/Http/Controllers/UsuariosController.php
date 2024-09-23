<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Usuarios::select('name', 'email','id')->get();
        return view('usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuarios $usuario)
    {
        $roles = Roles::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuarios $usuario)
    {
        $data = $request->all();

        $usuario->update([
            'rol_id' => $data['rol_id'],
        ]);

        return redirect()->route('usuarios.index', $usuario)->with('info', 'Se asignó el rol correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuarios $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index', $usuario)->with('info', 'Se eliminó el usuario correctamente');
    }
}
