<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Cliente
 * @package App\Models
 * @version September 19, 2022, 9:49 pm UTC
 *
 * @property string $nombre
 * @property string $ivacond
 * @property string $domicilio
 * @property string $telefono
 * @property string $email
 * @property string $tipodoc
 * @property string $documento
 * @property string $user_name
 */
class Cliente extends Model
{

    use HasFactory;

    public $table = 'clientes';
    



    public $fillable = [
        'nombre',
        'ivacond',
        'domicilio',
        'telefono',
        'email',
        'tipodoc',
        'documento',
        'user_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'ivacond' => 'string',
        'domicilio' => 'string',
        'telefono' => 'string',
        'email' => 'string',
        'tipodoc' => 'string',
        'documento' => 'string',
        'user_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'ivacond' => 'required',
        'tipodoc' => 'required',
        'documento' => 'required',
        'user_name' => 'nullable'
    ];

    
}
