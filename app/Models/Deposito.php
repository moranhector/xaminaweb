<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Deposito
 * @package App\Models
 * @version August 3, 2022, 1:32 pm UTC
 *
 * @property string $nombre
 * @property string $user_name
 */
class Deposito extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'depositos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'user_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'user_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required'
    ];

    
}
