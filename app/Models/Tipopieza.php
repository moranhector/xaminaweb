<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tipopieza
 * @package App\Models
 * @version July 26, 2022, 2:35 pm UTC
 *
 * @property string $descrip
 * @property string $tecnica
 * @property integer $rubro_id
 * @property number $precio
 * @property string $insumo
 */
class Tipopieza extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'tipopiezas';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'descrip',
        'tecnica',
        'rubro_id',
        'precio',
        'insumo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descrip' => 'string',
        'tecnica' => 'string',
        'rubro_id' => 'integer',
        'precio' => 'decimal:2',
        'insumo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descrip' => 'required',
        'tecnica' => 'required',
        'rubro_id' => 'required',
        'precio' => 'required',
        'insumo' => 'required'
    ];

    
}
