<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicios extends Model
{
    protected $table = 'servicios';

    public $timestamps = false;

    protected $fillable = [
        'nombre',

        'descripcion',
        'precio',
        'categoria',
        'duracion_minima',
        'duracion_maxima',
        'categoria',
        'estado',
    ];

    public function detallesCita() : HasMany
    {
        return $this->hasMany(DetalleCita::class, 'id_servicio');
    }

    public function categoria()
    {
        return $this->belongsTo(Categorias_de_Servicios::class, 'categoria');
    }
}
