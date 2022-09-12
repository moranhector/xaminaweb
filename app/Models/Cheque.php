<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Cheque
 * @package App\Models
 * @version July 27, 2022, 12:48 pm UTC
 *
 * @property integer $numero
 * @property string $fecha
 * @property number $importe
 * @property string $ncuenta
 * @property boolean $depositado
 * @property number $saldo
 */
class Cheque extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cheques';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'numero',
        'fecha',
        'importe',
        'ncuenta',
        'depositado',
        'saldo',
        'rendido_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'numero' => 'integer',
        'fecha' => 'date',
        'importe' => 'decimal:2',
        'ncuenta' => 'string',
        'depositado' => 'boolean',
        'saldo' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'numero' => 'unique:cheques,numero',
        'fecha' => 'required',
        'importe' => 'required',
        'ncuenta' => 'required',
        'saldo' => 'nullable'
    ];



    // $ultimo_formulario = Talonario::proximodocumento('REC');

    public function DescontarSaldo($idCheque,$MontoDescontar)
    {
        $cheque = Cheque::find($idCheque);
        //$cheque = Cheque::where('id', $idCheque)->first();

        //dd($cheque->saldo);
        
        $nSaldoNuevo = ($cheque->saldo )  - $MontoDescontar;
        
        $cheque->saldo = $nSaldoNuevo ;

        $cheque->save() ;
        
        return;

    }    



}
