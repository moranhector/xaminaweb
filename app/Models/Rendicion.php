<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Rendicion
 * @package App\Models
 * @version September 5, 2022, 10:52 pm UTC
 *
 * @property integer $cheque_id
 * @property integer $inventario_id
 * @property integer $recibo_id
 * @property number $importe
 */
class Rendicion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rendiciones';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'cheque_id',
        'inventario_id',
        'recibo_id',
        'importe'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cheque_id' => 'integer',
        'inventario_id' => 'integer',
        'recibo_id' => 'integer',
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
