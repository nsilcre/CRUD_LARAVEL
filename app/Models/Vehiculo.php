<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\Rule;

class Vehiculo extends Model
{
    use HasFactory;

    // Deshabilitar auto-incremento ya que usamos matrícula como PK
    public $incrementing = false;

    // Especificar el tipo de clave primaria
    protected $keyType = 'string';

    // Nombre de la clave primaria
    protected $primaryKey = 'matricula';

    protected $fillable = [
        'matricula',
        'marca',
        'modelo',
        'fecha_fabricacion',
        'disponible',
        'combustible',
        'precio',
        'kilometraje',
        'observaciones'
    ];

    protected $casts = [
        'fecha_fabricacion' => 'date',
        'disponible' => 'boolean',
        'precio' => 'decimal:2',
        'kilometraje' => 'integer'
    ];

    // Reglas de validación
    public static function rules($matricula = null)
    {
        return [
            'matricula' => [
                'required',
                'string',
                'max:10',
                'regex:/^[0-9]{4}[A-Z]{3}$/', // Formato: 1234ABC
                Rule::unique('vehiculos')->ignore($matricula, 'matricula')
            ],
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'fecha_fabricacion' => [
                'required',
                'date',
                'before_or_equal:today' // No puede ser fecha futura
            ],
            'disponible' => 'required|boolean',
            'combustible' => 'required|in:hibrido,electrico,gasolina,diesel',
            'precio' => 'nullable|numeric|min:0|max:1000000',
            'kilometraje' => 'required|integer|min:0|max:1000000',
            'observaciones' => 'nullable|string|max:500'
        ];
    }

    // Mensajes de validación personalizados
    public static function messages()
    {
        return [
            'matricula.regex' => 'La matrícula debe tener formato: 4 números + 3 letras (ej: 1234ABC)',
            'fecha_fabricacion.before_or_equal' => 'La fecha de fabricación no puede ser futura',
            'combustible.in' => 'El combustible debe ser: hibrido, electrico, gasolina o diesel'
        ];
    }

    // Scope para vehículos disponibles
    public function scopeDisponibles($query)
    {
        return $query->where('disponible', true);
    }

    // Scope para buscar por marca
    public function scopePorMarca($query, $marca)
    {
        return $query->where('marca', 'like', "%{$marca}%");
    }
}
