<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpleadosController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $empleados = Empleados::with('user')->where('rol_id', 2)->get();
      return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.create');

    }
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
        // Crear un registro en la tabla empleados usando el ID del usuario creado
        $user = User::create([
            'name' => $data['nombres'],
            'email' => $data['correo'],
            'password' => Hash::make($data['password']),
            'rol_id' => 3,
        ]);
        // Crear el usuario y obtener el modelo del usuario creado
        Empleados::create([
            'cedula' => $data['cedula'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'cargo' => $data['cargo'],
            'user_id' => $user->id,
            'rol_id' => 2
        ]);

        return redirect()->route('empleados.index')->with('success', 'empleados creado exitosamente.');
    }


    /**
     * Store a newly created resource in storage.
     */

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
    public function edit(Empleados $empleado)
    {
        $user = User::find($empleado->user_id);

        // Pasar tanto el cliente como el usuario a la vista de edición
        return view('empleados.edit', compact('empleado', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleados $empleado)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255',
            'cargo' => 'required|string|max:255',

            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Actualizar los datos del usuario asociado
        $user = User::find($empleado->user_id);
        $user->name = $request->nombres;
        $user->email = $request->correo;

        // Solo actualizar la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Actualizar los datos del cliente
        $empleado->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'cargo' => $request->cargo,


        ]);

        return redirect()->route('empleados.index')->with('success', 'empleado actualizado exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleados $empleado)
    {
        {
            $user = User::find($empleado->user_id);
            $user->delete();
            $empleado->delete();
            return redirect()->route('empleados.index')->with('success', 'empleado eliminado exitosamente.');
        }
    }
}
