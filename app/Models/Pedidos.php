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
        'fecha-hora_pedido',
        'estado',
        'clave_entrega',
        'id_comprador',
        'es_estudiante',
        'id_estudiante',
        'estado_pago',
        'fecha_pago',
        'stripe_payment_id',
    ];
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id');
    }

    public function comprador(): BelongsTo
    {
        return $this->belongsTo(Comprador::class, 'id_comprador');
    }


    public function entrega()
    {
        return $this->hasOne(Entregas::class, 'id_pedido'); // Cambia Entrega::class por el nombre correcto del modelo
    }
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }

}
