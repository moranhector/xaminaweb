<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Factura
 * @package App\Models
 * @version September 19, 2022, 10:24 pm UTC
 *
 * @property string $formulario
 * @property string $ptovta
 * @property string $tipo
 * @property string $fecha
 * @property integer $cliente_id
 * @property number $total
 * @property string $ivacond
 * @property string $domicilio
 * @property string $telefono
 * @property string $email
 * @property string $tipodoc
 * @property string $documento
 */
class Factura extends Model
{

    use HasFactory;

    public $table = 'facturas';
    



    public $fillable = [
        'formulario',
        'ptovta',
        'tipo',
        'fecha',
        'cliente_id',
        'total',
        'ivacond',
        'domicilio',
        'telefono',
        'email',
        'tipodoc',
        'documento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'formulario' => 'string',
        'ptovta' => 'string',
        'tipo' => 'string',
        'fecha' => 'date',
        'cliente_id' => 'integer',
        'total' => 'decimal:2',
        'ivacond' => 'string',
        'domicilio' => 'string',
        'telefono' => 'string',
        'email' => 'string',
        'tipodoc' => 'string',
        'documento' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'formulario' => 'required',
        'ptovta' => 'required',
        'tipo' => 'required',
        'fecha' => 'required',
        'cliente_id' => 'required',
        'ivacond' => 'required',
        'tipodoc' => 'required',
        'documento' => 'required'
    ];

    
}
