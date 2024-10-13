<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicios extends Model
{
    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria',
    ];

    public function detallesCita() : HasMany
    {
        return $this->hasMany(DetalleCita::class, 'id_servicio');
    }
}
