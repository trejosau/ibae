<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleVenta extends Model
{

    protected $table = 'detalle_venta';

    public $timestamps = false;

    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_aplicado',
        'descuento',
    ];


    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'id_venta');
    }

    // Relación con productos (un detalle tiene muchos productos)
    public function productos()
    {
        return $this->belongsTo(Productos::class, 'id_producto'); // Asegúrate de que 'id_producto' sea la clave foránea
    }
}
