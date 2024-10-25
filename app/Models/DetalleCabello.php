<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleCabello extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'detalle_cabello';

    protected $fillable = [
        'id_detalle_cita',
        'largo',
        'volumen',
        'estado',
    ];

    public function detalleCita() : BelongsTo
    {
        return $this->belongsTo(DetalleCita::class, 'id_detalle_cita');
    }
}
