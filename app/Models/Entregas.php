<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entregas extends Model
{

    protected $table = 'entregas';

    public $timestamps = false;

    protected $fillable = [
        'id_pedido',
        'id_admin',
        'fecha_hora_entregado',
        'fecha_hora_listo_entregar',
        'estado',
        'nombre_recolector',
    ];

    public function pedido() : BelongsTo
    {
        return $this->belongsTo(Pedidos::class, 'id_pedido');
    }

    public function administrador() : BelongsTo
    {
        return $this->belongsTo(Administrador::class, 'id_admin' );
    }
}
