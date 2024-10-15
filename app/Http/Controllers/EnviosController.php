<?php

namespace App\Http\Controllers;

use App\Models\Envios;
use App\Models\Empleados;
use App\Models\Clientes;
use App\Models\EnviosDetalles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\PostEnvios;
use Illuminate\Support\Facades\Mail;

class EnviosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los envíos con sus detalles
        $envios = Envios::with('enviosDetalles')->get();

        return view('envios.index', compact('envios'));
    }

    public function sends()
{
    // Verifica si el usuario es un cliente (role_id == 3)
    if (auth()->Auth::user()->role_id == 3) {
        // Obtener los envíos relacionados al cliente autenticado
        $envios = Envios::with('enviosDetalles')
            ->where('clientes_idremitente', auth()->Auth::user()->id)
            ->orWhere('clientes_iddestinatario', auth()->Auth::user()->id)
            ->get();

        return view('envios.sends', compact('envios'));
    }

    // Si no es un cliente, redirige con un mensaje de error
    return redirect()->back()->with('error', 'No tienes permisos para ver los envíos.');
}
public function misEnvios()
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Obtener el cliente asociado a este usuario
    $cliente = $user->cliente; // Asumiendo que tienes una relación 'cliente' en el modelo User.

    // Validar si el cliente existe
    if (!$cliente) {
        return redirect()->route('home')->with('error', 'No tienes permisos para ver esta página.');
    }

    // Obtener los envíos que están asociados a este cliente
    $envios = Envios::where('clientes_idremitente', $cliente->id)->get();

    // Pasar los envíos a la vista
    return view('envios.mis-envios', compact('envios'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('envios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validación de los datos de entrada
        // $request->validate([
        //     'origen' => 'required|string|max:45',
        //     'destino' => 'required|string|max:45',
        //     'descripcion' => 'required|string',
        //     'codigo_envio' => 'nullable|string|max:45',
        //     'estado' => 'required|integer',
        //     'detalles.*.peso' => 'nullable|numeric',
        //     'detalles.*.alto' => 'nullable|numeric',
        //     'detalles.*.ancho' => 'nullable|numeric',
        //     'detalles.*.profundidad' => 'nullable|numeric',
        //     'detalles.*.cantidad' => 'nullable|numeric',
        //     'detalles.*.valor_unidad' => 'nullable|numeric',
        //     'detalles.*.valor_total' => 'required|numeric',
        // ]);
        $data = $request->all();

        $idremitente = Clientes::where('cedula',$request->idremitente)->first();

        $iddestinatario = Clientes::where('cedula',$request->iddestinatario)->first();

        $idempleado = Empleados::where('user_id', Auth::user()->id)->first();

        //ayudame a sacar el timestamp unico para el envío
        $codigo_envio = date('YmdHis');

        // dd($idempleado);
        // Creación del nuevo envío
        $envio = Envios::create([
            'origen' => $request->origen,
            'destino' => $request->destino,
            'descripcion' => $request->descripcion,
            'codigo_envio' => $codigo_envio,
            'empleados_idempleados' => $idempleado->id,
            'clientes_idremitente' => $idremitente->id,
            'clientes_iddestinatario' => $iddestinatario->id
        ]);

        // Iterar sobre los detalles del envío y guardarlos
        if ($request->has('detalles')) {
            foreach ($request->detalles as $detalle) {
                EnviosDetalles::create([
                    'envios_idenvios' => $envio->id, // Relacionar con el envío recién creado
                    'peso' => $detalle['peso'],
                    'alto' => $detalle['alto'],
                    'ancho' => $detalle['ancho'],
                    'profundidad' => $detalle['profundidad'],
                    'cantidad' => $detalle['cantidad'],
                    'valor_unidad' => $detalle['valor_unidad'],
                    'valor_total' => $detalle['valor_total'],
                    'unidad_peso' => isset($detalle['unidad_peso']) ? $detalle['unidad_peso'] : null,
                    'unidad_medidas' => isset($detalle['unidad_medidas']) ? $detalle['unidad_medidas'] : null,
                    'unidad_cantidades' => isset($detalle['unidad_cantidades']) ? $detalle['unidad_cantidades'] : null,
                ]);
            }
        }

        Mail::to('davilsonexty@gmail.com')->send(new PostEnvios());
        return redirect()->route('envios.index')->with('success', 'Envío y detalles creados con éxito');

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
    public function edit($id)
    {
        // Buscar el envío por su id
        $envio = Envios::with('enviosDetalles')->findOrFail($id);
        dd($envio);
        return view('envios.edit', compact('envio'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos de entrada
        $request->validate([
            'origen' => 'required|string|max:45',
            'destino' => 'required|string|max:45',
            'descripcion' => 'required|string',
            'codigo_envio' => 'nullable|string|max:45',
            'estado' => 'required|integer',
            'detalles.*.peso' => 'nullable|numeric',
            'detalles.*.alto' => 'nullable|numeric',
            'detalles.*.ancho' => 'nullable|numeric',
            'detalles.*.profundidad' => 'nullable|numeric',
            'detalles.*.cantidad' => 'nullable|numeric',
            'detalles.*.valor_unidad' => 'nullable|numeric',
            'detalles.*.valor_total' => 'required|numeric',
        ]);
        $envio = Envios::findOrFail($id);

        // Actualizar los datos del envío
        $envio->update([
            'origen' => $request->origen,
            'destino' => $request->destino,
            'descripcion' => $request->descripcion,
            'codigo_envio' => $request->codigo_envio,
            'estado' => $request->estado,
        ]);

        // Eliminar los detalles actuales y agregar los nuevos
        $envio->enviosDetalles()->delete();

        if ($request->has('detalles')) {
            foreach ($request->detalles as $detalle) {
                EnviosDetalles::create([
                    'envios_idenvios' => $envio->id,
                    'peso' => $detalle['peso'],
                    'alto' => $detalle['alto'],
                    'ancho' => $detalle['ancho'],
                    'profundidad' => $detalle['profundidad'],
                    'cantidad' => $detalle['cantidad'],
                    'valor_unidad' => $detalle['valor_unidad'],
                    'valor_total' => $detalle['valor_total'],
                    'unidad_peso' => isset($detalle['unidad_peso']) ? $detalle['unidad_peso'] : null,
                    'unidad_medidas' => isset($detalle['unidad_medidas']) ? $detalle['unidad_medidas'] : null,
                    'unidad_cantidades' => isset($detalle['unidad_cantidades']) ? $detalle['unidad_cantidades'] : null,
                ]);
            }
        }

        return redirect()->route('envios.index')->with('success', 'Envío actualizado con éxito');
    }


    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(string $id)
    {
        $envio = Envios::findOrFail($id);

        // Eliminar los detalles relacionados
        $envio->enviosDetalles()->delete();

        // Eliminar el envío
        $envio->delete();

        return redirect()->route('envios.index')->with('success', 'Envío eliminado con éxito');

    }
}
