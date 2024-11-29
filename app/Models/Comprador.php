<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comprador extends Model
{
    protected $table = 'compradores';

    protected $fillable = [
        'id_persona',
        'razon_social',
    ];

    public function persona() : BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  // Relación con la columna `user_id`
    }
}
