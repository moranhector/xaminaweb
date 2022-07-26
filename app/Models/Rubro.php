<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Rubro
 * @package App\Models
 * @version July 26, 2022, 1:09 pm UTC
 *
 * @property string $descrip
 */
class Rubro extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rubros';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'descrip'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descrip' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descrip' => 'required'
    ];

    
}
