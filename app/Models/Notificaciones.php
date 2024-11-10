<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table = 'notificaciones';

    public $timestamps = false;

    protected $fillable = [
        'motivo',
        'mensaje',
        'user_id',
        'leida_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
