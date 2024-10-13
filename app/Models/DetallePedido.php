<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedido';

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'cantidad',
        'precio_aplicado',
        'descuento',
    ];

    public function pedido() : BelongsTo
    {
        return $this->belongsTo(Pedidos::class, 'id_pedido');
    }

    public function producto() : BelongsTo
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
}
