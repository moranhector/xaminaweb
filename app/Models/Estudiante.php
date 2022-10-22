<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Estudiante
 * @package App\Models
 * @version October 21, 2022, 11:02 pm UTC
 *
 * @property string $nombre
 * @property string $documento
 * @property string $direccion
 * @property string $departamento
 */
class Estudiante extends Model
{

    use HasFactory;

    public $table = 'estudiantes';
    



    public $fillable = [
        'nombre',
        'documento',
        'direccion',
        'departamento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'documento' => 'string',
        'direccion' => 'string',
        'departamento' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'documento' => 'required',
        'direccion' => 'required',
        'departamento' => 'required'
    ];

    
}
