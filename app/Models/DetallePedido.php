<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetallePedido extends Model
{

    protected $table = 'detalle_pedido';

    public $timestamps = false;

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'cantidad',
        'precio_aplicado',
        'descuento',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'id_pedido', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto', 'id');
    }

}
