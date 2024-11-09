<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compras extends Model
{

    protected $table = 'compras';

    public $timestamps = false;

    protected $fillable = [
        'id_proveedor',
        'fecha_compra',
        'fecha_entrega',
        'estado',
        'motivo',
        'total',
    ];

    public function proveedor() : BelongsTo
    {
        return $this->belongsTo(Proveedores::class, 'id_proveedor');
    }

    public function productos()
    {
        return $this->belongsToMany(Productos::class, 'detalle_compra', 'id_compra', 'id_producto')
            ->withPivot('cantidad');
    }

}
