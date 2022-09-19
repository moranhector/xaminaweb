<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Faclinea
 * @package App\Models
 * @version September 19, 2022, 10:30 pm UTC
 *
 * @property integer $factura_id
 * @property integer $inventario_id
 * @property integer $cantidad
 * @property number $preciounit
 * @property number $importe
 */
class Faclinea extends Model
{

    use HasFactory;

    public $table = 'faclineas';
    



    public $fillable = [
        'factura_id',
        'inventario_id',
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
        'factura_id' => 'integer',
        'inventario_id' => 'integer',
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
