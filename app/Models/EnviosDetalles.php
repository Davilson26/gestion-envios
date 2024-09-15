<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnviosDetalles extends Model
{
    use HasFactory;
    protected $table = 'envios_detalles';
    protected $fillable = ['peso', 'alto', 'ancho', 'profundidad', 'cantidad', 'volumen', 'valor_unidad', 'valor_total', 'unidad_peso', 'unidad_medidas', 'unidad_cantidades', 'envios_idenvios'];

    // Relación con envios (inversa)
    public function envio()
    {
        return $this->belongsTo(Envios::class, 'envios_idenvios', 'id');
    }
}
