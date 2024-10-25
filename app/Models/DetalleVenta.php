<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_venta';

    public $timestamps = false;

    protected $fillable = [
        'id_venta',
        'id_producto',
        'precio_aplicado',
        'descuento',
    ];


    public function venta() : BelongsTo
    {
        return $this->belongsTo(Ventas::class, 'id_venta');
    }


    public function producto() : BelongsTo
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
}
