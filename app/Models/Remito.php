<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Remito
 * @package App\Models
 * @version October 1, 2022, 11:21 am UTC
 *
 * @property string $descrip
 * @property string $fecha
 * @property integer $deposito_id_from
 * @property integer $deposito_id_to
 * @property string $user_name
 */
class Remito extends Model
{

    use HasFactory;

    public $table = 'remitos';
    



    public $fillable = [
        'descrip',
        'fecha',
        'deposito_id_from',
        'deposito_id_to',
        'user_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descrip' => 'string',
        'fecha' => 'date',
        'deposito_id_from' => 'integer',
        'deposito_id_to' => 'integer',
        'user_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
