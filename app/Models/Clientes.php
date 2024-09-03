<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $fillable = ['cedula', 'nombres', 'apellidos', 'telefono', 'direccion', 'user_id'];
    
    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
