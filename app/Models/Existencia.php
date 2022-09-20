<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Existencia
 * @package App\Models
 * @version September 20, 2022, 9:28 pm UTC
 *
 * @property integer $inventario_id
 * @property string $tipodoc
 * @property string $documento
 * @property integer $deposito_id
 * @property string $tiposalida
 * @property string $documento_sal
 * @property string $fecha_desde
 * @property string $fecha_hasta
 * @property string $user_name
 */
class Existencia extends Model
{

    use HasFactory;

    public $table = 'existencias';
    



    public $fillable = [
        'inventario_id',
        'tipodoc',
        'documento',
        'deposito_id',
        'tiposalida',
        'documento_sal',
        'fecha_desde',
        'fecha_hasta',
        'user_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inventario_id' => 'integer',
        'tipodoc' => 'string',
        'documento' => 'string',
        'deposito_id' => 'integer',
        'tiposalida' => 'string',
        'documento_sal' => 'string',
        'fecha_desde' => 'date',
        'fecha_hasta' => 'date',
        'user_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'inventario_id' => 'required',
        'tipodoc' => 'required',
        'documento' => 'required',
        'deposito_id' => 'required',
        'tiposalida' => 'nullable',
        'documento_sal' => 'nullable',
        'fecha_desde' => 'required',
        'fecha_hasta' => 'nullable',
        'user_name' => 'nullable'
    ];

    
}
