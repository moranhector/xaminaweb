<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RecibosLineas
 * @package App\Models
 * @version July 27, 2022, 2:51 pm UTC
 *
 * @property integer $recibo_id
 * @property integer $tipopieza_id
 * @property integer $cantidad
 * @property number $preciounit
 * @property number $importe
 */
class RecibosLineas extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'recibos_lineas';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'recibo_id',
        'tipopieza_id',
        'cantidad',
        'preciounit',
        'importe'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'recibo_id' => 'integer',
        'tipopieza_id' => 'integer',
        'cantidad' => 'integer',
        'preciounit' => 'decimal:2',
        'importe' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
