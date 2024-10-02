<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = ['cedula', 'nombres', 'apellidos', 'telefono', 'direccion'];

    // Relación con envios
    public function enviosRemitente()
    {
        return $this->hasMany(Envios::class, 'clientes_idremitente', 'id');
    }

    public function enviosDestinatario()
    {
        return $this->hasMany(Envios::class, 'clientes_iddestinatario', 'id');
    }
}

