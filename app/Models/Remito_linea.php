<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Remito_linea
 * @package App\Models
 * @version October 1, 2022, 11:30 am UTC
 *
 * @property integer $remito_id
 * @property integer $inventario_id
 */
class Remito_linea extends Model
{

    use HasFactory;

    public $table = 'remito_lineas';
    



    public $fillable = [
        'remito_id',
        'inventario_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'remito_id' => 'integer',
        'inventario_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
