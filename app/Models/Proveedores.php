<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedores extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre_persona',
        'nombre_empresa',
        'contacto_telefono',
        'contacto_correo',
    ];

    public function productos() : HasMany
    {
        return $this->hasMany(Productos::class, 'id_proveedor');
    }
}
