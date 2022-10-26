<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
/**
 * Class Talonario
 * @package App\Models
 * @version August 29, 2022, 10:17 pm UTC
 *
 * @property string $tipo
 * @property string $ptoventa
 * @property string $proximodoc
 * @property string $fechavto
 */
class Talonario extends Model
{
    

    use HasFactory;

    public $table = 'talonarios';
    

   



    public $fillable = [
        'tipo',
        // 'ptoventa',
        'proximodoc',
        // 'fechavto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tipo' => 'string',
        // 'ptoventa' => 'string',
        'proximodoc' => 'string',
        // 'fechavto' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    // $ultimo_formulario = Talonario::proximodocumento('REC');

    public function proximodocumento($tipo)
    {
        $talonario = Talonario::where('tipo', $tipo)->first();

            return $talonario->proximodoc;

    }

    public function Actualizarproximodocumento($tipo,$valor)
    {
        $talonario = Talonario::where('tipo', $tipo)->first();
        $UltimoDoc = $valor;
        $nProximoDoc = strval($UltimoDoc) + 1  ;
        $talonario->proximodoc = $nProximoDoc;
        $talonario->save();
            return ;

    }

    /**
     * Actualizar Formularios
     *
     * @param int $id
     * @param UpdateTalonarioRequest $request
     *
     * @return Response
     */
    public function Actualizar($tipo, $UltimoDoc)
    {
        /** @var Talonario $talonario */

        //$talonario = Talonario::where('tipo', '==', $tipo)->firstOrFail();
        $talonario = Talonario::where('tipo', $tipo)->first();

        $nProximoDoc = strval($UltimoDoc) + 1  ;



        $talonario->proximodoc = $nProximoDoc;
        $talonario->updated_at = Carbon::now();
        $talonario->save();

        

        return $nProximoDoc ;
    }

        


}
