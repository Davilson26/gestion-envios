<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\User;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $clientes = Clientes::all();
      return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nombre' => 'required|string|max:255',
        //     'apellido' => 'required|string|max:255',
        //     'correo' => 'required|string|email|max:255',
        //     'telefono' => 'required|string|max:255',
        //     'direccion' => 'required|string|max:255',
        //     'password' => 'required|string|max:255',
        //     'id_rol' => 'required|integer'
        // ]);
        
        $data = $request->all();
        $user['name'] = $data['nombres'];
        $user['email'] = $data['correo'];
        $user['password'] = bcrypt($request->password);
        $user['rol_id'] = $data['rol_id'];
        // dd($user)  ;
        $user = User::create($data);

        $idUser = $user->id;
        $data['usuarios_id'] = $idUser;

        Clientes::create($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clientes $cliente)
    {
        return view('clientes.editar', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clientes $cliente)
    {
        // $request->validate([
        //     'nombre' => 'required|string|max:255',
        //     'apellido' => 'required|string|max:255',
        //     'correo' => 'required|string|email|max:255',
        //     'telefono' => 'required|string|max:255',
        //     'direccion' => 'required|string|max:255',
        // ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    
    }
}
