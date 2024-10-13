<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $table = 'detalle_compra';

    protected $fillable = [
        'id_compra',
        'id_producto',
        'cantidad',
    ];

    public function compra() : BelongsTo
    {
        return $this->belongsTo(Compras::class, 'id_compra');
    }

    public function producto() : BelongsTo
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
}
