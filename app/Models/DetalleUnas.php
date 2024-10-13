<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleUnas extends Model
{
    use HasFactory;

    protected $table = 'detalle_unas';

    protected $fillable = [
        'id_detalle_cita',
        'largo',
        'cantidad_piedras',
        'cantidad_cristales',
        'cantidad_stickers',
        'cantidad_efecto_foil',
        'cantidad_efecto_espejo',
        'cantidad_efecto_azucar',
        'cantidad_efecto_mano_alzada',
        'cantidad_efecto_3d',
    ];

    public function detalleCita() : BelongsTo
    {
        return $this->belongsTo(DetalleCita::class, 'id_detalle_cita');
    }
}
