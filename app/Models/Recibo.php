<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Recibo
 * @package App\Models
 * @version July 27, 2022, 2:33 pm UTC
 *
 * @property string $formulario
 * @property string $fecha
 * @property integer $artesano_id
 * @property number $total
 * @property integer $cheque_id
 * @property boolean $rendido
 */
class Recibo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'recibos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'formulario',
        'fecha',
        'artesano_id',
        'total',
        'cheque_id',
        'rendido', 
        'user_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'formulario' => 'string',
        'fecha' => 'date',
        'artesano_id' => 'integer',
        'total' => 'decimal:2',
        'cheque_id' => 'integer',
        'rendido' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'formulario' => 'required',
        'fecha' => 'required',
        // 'artesano_id' => 'required'
    ];

    
}
