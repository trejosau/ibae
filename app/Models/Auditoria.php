<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditorias';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'afectado_user_id',
        'accion',
        'motivo',
        'detalles',
        'fecha',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function afectadoUser()
    {
        return $this->belongsTo(User::class, 'afectado_user_id');
    }
}
