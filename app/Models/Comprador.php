<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comprador extends Model
{
    use HasFactory;

    protected $table = 'compradores';

    protected $fillable = [
        'id_persona',
        'preferencia',
        'razon_social',
    ];

    public function persona() : BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
