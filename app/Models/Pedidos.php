<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedidos extends Model
{
    protected $table = 'pedidos';

    public $timestamps = false;

    protected $fillable = [
        'total',
        'fecha_pedido',
        'estado',
        'clave_entrega',
        'id_comprador',
        'es_estudiante',
    ];

    public function comprador(): BelongsTo
    {
        return $this->belongsTo(Comprador::class, 'id_comprador');
    }
}
