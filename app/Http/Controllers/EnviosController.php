<?php

namespace App\Http\Controllers;

use App\Models\Envios;
use App\Models\EnviosDetalles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        // Creación del nuevo envío
        $envio = Envios::create([
            'origen' => $request->origen,
            'destino' => $request->destino,
            'descripcion' => $request->descripcion,
            'codigo_envio' => $request->codigo_envio,
            'estado' => $request->estado,
            'empleados_idempleados' => $request->empleados_idempleados,
            
            // Si tienes relaciones de clientes o empleados, agrega aquí las claves foráneas
            // 'empleados_idempleados' => $request->empleados_idempleados,
            // 'clientes_idremitente' => $request->clientes_idremitente,
            // 'clientes_iddestinatario' => $request->clientes_iddestinatario,
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
