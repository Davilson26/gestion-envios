<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The attributes that should be use to validate.
     *
     * @var array<int, string>
     */
    public function role()
    {
        return $this->belongsTo(Roles::class, 'rol_id');
    }

    // Relación con Cliente
    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'user_id');
        return $this->hasOne(Clientes::class, 'user_id');
    }

    // Relación con Empleado
    public function empleados()
    {
        return $this->hasMany(Empleados::class, 'user_id');
    }
    public function hasRole(array $roles)
    {
        return in_array($this->rol_id, $roles);
    }
}
