<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envios extends Model
{
    use HasFactory;
    protected $fillable = ['origen', 'destino', 'descripcion', 'codigo_envio', 'estado', 'empleados_idempleados', 'clientes_idremitente', 'clientes_iddestinatario'];

    
    // Relación con envios_detalles
    public function enviosDetalles()
    {
        return $this->hasMany(EnviosDetalles::class, 'envios_idenvios', 'id');
    }
}
