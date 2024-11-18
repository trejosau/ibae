<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';

    public $timestamps = false;

    protected $fillable = [
        'nombre_comprador',
        'fecha_compra',
        'total',
        'id_admin',
        'es_estudiante',
        'matricula',
    ];

    public function vendedor()
    {
        return $this->belongsTo(Administrador::class, 'id_admin', 'id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_admin'); // 'id_admin' es la clave foránea
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'matricula');
    }

}

