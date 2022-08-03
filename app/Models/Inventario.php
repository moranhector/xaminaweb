<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Inventario
 * @package App\Models
 * @version August 3, 2022, 1:54 pm UTC
 *
 * @property string $codigo12
 * @property integer $tipopieza_id
 * @property string $npieza
 * @property string $namepieza
 * @property string $comprob
 * @property string $recibo_id
 * @property string $factura
 * @property string $factura_id
 * @property number $costo
 * @property string $recargo
 * @property integer $artesano_id
 * @property string $comprado_at
 * @property string $vendido_at
 * @property number $precio
 * @property string $precio_at
 * @property string $foto
 */
class Inventario extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'inventarios';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'codigo12',
        'tipopieza_id',
        'npieza',
        'namepieza',
        'comprob',
        'recibo_id',
        'factura',
        'factura_id',
        'costo',
        'recargo',
        'artesano_id',
        'comprado_at',
        'vendido_at',
        'precio',
        'precio_at',
        'foto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'codigo12' => 'string',
        'tipopieza_id' => 'integer',
        'npieza' => 'string',
        'namepieza' => 'string',
        'comprob' => 'string',
        'recibo_id' => 'string',
        'factura' => 'string',
        'factura_id' => 'string',
        'costo' => 'decimal:2',
        'recargo' => 'string',
        'artesano_id' => 'integer',
        'comprado_at' => 'date',
        'vendido_at' => 'date',
        'precio' => 'decimal:2',
        'precio_at' => 'date',
        'foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo12' => 'required',
        'tipopieza_id' => 'required',
        'npieza' => 'required',
        'namepieza' => 'required',
        'comprob' => 'required',
        'costo' => 'required',
        'precio' => 'required'
    ];

    
}
