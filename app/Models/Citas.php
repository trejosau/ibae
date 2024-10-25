<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;


    protected $table = 'citas';
    public $timestamps = false;

    protected $fillable = [
        'id_estilista',
        'id_comprador',
        'fecha_hora_creacion',
        'fecha_hora_inicio_cita',
        'fecha_hora_fin_cita',
    ];

    public function estilista() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Estilista::class, 'id_estilista');
    }

    public function comprador() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Comprador::class, 'id_comprador');
    }
}
