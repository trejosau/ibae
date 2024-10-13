<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuloTemas extends Model
{
    protected $table = 'modulo_temas';

    protected $fillable = [
        'id_modulo',
        'id_tema',
    ];

    public function modulo(): BelongsTo
    {
        return $this->belongsTo(Modulos::class, 'id_modulo');
    }

    public function tema(): BelongsTo
    {
        return $this->belongsTo(Temas::class, 'id_tema');
    }
}
