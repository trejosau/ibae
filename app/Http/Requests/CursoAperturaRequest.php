<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoAperturaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Reglas de validación para la solicitud.
     */
    public function rules()
    {
        return [
            'id_curso' => 'required|exists:cursos,id',
            'fecha_inicio' => 'required|date',
            'hora_clase' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $hora = \Carbon\Carbon::createFromFormat('H:i', $value);
                    $inicio = \Carbon\Carbon::createFromTime(8, 0);  // 8:00 AM
                    $fin = \Carbon\Carbon::createFromTime(22, 0);   // 10:00 PM
    
                    if ($hora->lt($inicio) || $hora->gt($fin)) {
                        $fail('La hora debe estar entre las 8:00 a.m. y las 10:00 p.m.');
                    }
                },
            ],
            'monto_colegiatura' => 'required|integer|min:1',
            'modulos' => 'required|array',
            'id_profesor' => 'required|exists:profesores,id',
        ];
    }
    

    /**
     * Mensajes personalizados para las reglas de validación.
     */
    public function messages()
    {
        return [
            'id_curso.required' => 'El curso es obligatorio.',
            'id_curso.exists' => 'El curso seleccionado no es válido.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'hora_clase.required' => 'La hora de clase es obligatoria.',
            'hora_clase.date_format' => 'La hora de clase debe estar en el formato HH:mm.',
            'hora_clase.custom' => 'La hora debe estar entre las 8:00 a.m. y las 10:00 p.m.',
            'monto_colegiatura.required' => 'El monto de la colegiatura es obligatorio.',
            'monto_colegiatura.integer' => 'El monto de la colegiatura debe ser un número entero.',
            'monto_colegiatura.min' => 'El monto de la colegiatura debe ser al menos 1.',
            'modulos.required' => 'Debe seleccionar al menos un módulo para cada semana.',
            'modulos.array' => 'Los módulos deben estar en un formato de arreglo.',
            'id_profesor.required' => 'Debe seleccionar un profesor.',
            'id_profesor.exists' => 'El profesor seleccionado no es válido.',
        ];
    }
}
