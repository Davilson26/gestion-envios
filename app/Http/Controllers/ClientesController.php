<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('can:admin.cargos.index')->only('index');
    //     $this->middleware('can:admin.cargos.store')->only('store');
    //     $this->middleware('can:admin.cargos.edit')->only('edit', 'update');
    //     $this->middleware('can:admin.cargos.destroy')->only('destroy');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $clientes = Clientes::with('user')->get();
      return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function verEnvios()
    {
        // Obtener el ID del usuario autenticado
        $userId = auth()->id(); // Asegúrate de que esto esté correcto

        // Obtener el cliente asociado al usuario
        $cliente = Clientes::where('user_id', $userId)->first();

        if ($cliente) {
            // Obtener los envíos del cliente
            $envios = $cliente->envios; // Usar la relación definida en el modelo Clientes
            return view('clientes.envios', compact('envios'));
        } else {
            // Si no hay un cliente asociado al usuario
            return redirect()->route('clientes.index')->with('error', 'No se encontraron envíos para este cliente.');
        }
    }
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
        // Crear un registro en la tabla clientes usando el ID del usuario creado
        $user = User::create([
            'name' => $data['nombres'],
            'email' => $data['correo'],
            'password' => Hash::make($data['password']),
            'rol_id' => 3,
        ]);
        // Crear el usuario y obtener el modelo del usuario creado
        Clientes::create([
            'cedula' => $data['cedula'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'user_id' => $user->id,
        ]);
        
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
    // Obtener el usuario asociado al cliente
    $user = User::find($cliente->user_id);

    // Pasar tanto el cliente como el usuario a la vista de edición
    return view('clientes.edit', compact('cliente', 'user'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clientes $cliente)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255',
            'telefono' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        // Actualizar los datos del usuario asociado
        $user = User::find($cliente->user_id);
        $user->name = $request->nombres;
        $user->email = $request->correo;
    
        // Solo actualizar la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        // Actualizar los datos del cliente
        $cliente->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);
    
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $cliente)
    {
        $user = User::find($cliente->user_id);
        $user->delete();
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
