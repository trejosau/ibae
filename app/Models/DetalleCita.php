<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleCita extends Model
{
    use HasFactory;

    protected $table = 'detalle_cita';

    protected $fillable = [
        'id_cita',
        'id_servicio',
    ];

    public function cita() : BelongsTo
    {
        return $this->belongsTo(Citas::class, 'id_cita');
    }

    public function servicio() : BelongsTo
    {
        return $this->belongsTo(Servicios::class, 'id_servicio');
    }
}
