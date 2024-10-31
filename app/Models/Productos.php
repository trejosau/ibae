<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Productos extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'marca',
        'precio_proveedor',
        'precio_lista',
        'precio_venta',
        'cantidad',
        'medida',
        'id_proveedor',
        'main_photo',
        'stock',
        'estado',
        'fecha_agregado',
        'id_categoria'
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedores::class, 'id_proveedor');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto'); // Relación inversa
    }
}
