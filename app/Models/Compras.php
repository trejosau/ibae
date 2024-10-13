<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compras extends Model
{
    use HasFactory;

    protected $table = 'compras';

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
}
