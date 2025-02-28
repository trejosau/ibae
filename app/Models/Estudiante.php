<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Estudiante extends Model
{

    protected $primaryKey = 'matricula';
    protected $table = 'estudiantes';


    protected $fillable = [
        'id_persona',
        'id_inscripcion',
        'fecha_inscripcion',
        'grado_estudio',
        'zipcode',
        'ciudad',
        'colonia',
        'calle',
        'num_ext',
        'num_int',
    ];




    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id');
    }



    public function estudianteCurso()
    {
        return $this->hasMany(EstudianteCurso::class, 'id_estudiante');
    }

    public function cursosApertura()
    {
        return $this->belongsToMany(CursoApertura::class, 'estudiante_curso', 'id_estudiante', 'id_curso_apertura')
            ->withPivot('estado');
    }


    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'id_inscripcion', 'id');
    }




    public function pedidos()
    {
        return $this->hasMany(Pedidos::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(CursoApertura::class, 'estudiante_curso', 'id_estudiante', 'id_curso_apertura');
    }

    public function ventas()
    {
        return $this->hasMany(Ventas::class, 'matricula');
    }
}
