<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Existencia
 * @package App\Models
 * @version September 20, 2022, 9:28 pm UTC
 *
 * @property integer $inventario_id
 * @property string $tipodoc
 * @property string $documento
 * @property integer $deposito_id
 * @property string $tiposalida
 * @property string $documento_sal
 * @property string $fecha_desde
 * @property string $fecha_hasta
 * @property string $user_name
 */
class Existencia extends Model
{

    use HasFactory;

    public $table = 'existencias';
    



    public $fillable = [
        'inventario_id',
        'tipodoc',
        'documento',
        'deposito_id',
        'tiposalida',
        'documento_sal',
        'fecha_desde',
        'fecha_hasta',
        'user_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inventario_id' => 'integer',
        'tipodoc' => 'string',
        'documento' => 'string',
        'deposito_id' => 'integer',
        'tiposalida' => 'string',
        'documento_sal' => 'string',
        'fecha_desde' => 'date',
        'fecha_hasta' => 'date',
        'user_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'inventario_id' => 'required',
        'tipodoc' => 'required',
        'documento' => 'required',
        'deposito_id' => 'required',
        'tiposalida' => 'nullable',
        'documento_sal' => 'nullable',
        'fecha_desde' => 'required',
        'fecha_hasta' => 'nullable',
        'user_name' => 'nullable'
    ];


    public function estaDisponible( $inventario_id)
    {
        $existencia = new Existencia();                
        $existencia = Existencia::where('inventario_id', $inventario_id)
        ->where('fecha_hasta',null)->get();

        if ( $existencia->count() > 0 ) {
            return true ;  
        }
        return false ;
    }

    public function estaDisponibleDeposito( $inventario_id, $deposito_id)
    {
        $existencia = new Existencia();                
        $existencia = Existencia::where('inventario_id', $inventario_id)
        ->where('deposito_id', $deposito_id)
        ->where('fecha_hasta',null)->get();

        if ( $existencia->count() > 0 ) {
            return true ;  
        }
        return false ;
    }


    public function Actualizar($inventario_id, $deposito_id, $fecha_hasta, $tiposalida, $documento_sal , $deposito_id_to = false  ) {

        //dd( $inventario_id, $deposito_id, $fecha_hasta, $tiposalida, $documento_sal , $deposito_id_to );
        try {
                        //Cerrar existencia anterior
                        $existencia = new Existencia();                
                        $existencia = Existencia::where('inventario_id', $inventario_id )
                        ->where('fecha_hasta',null)
                        ->first();

                        if ( ! Existencia::estaDisponibleDeposito( $inventario_id, $deposito_id) ) {
                            return false ;  
                        }


                        $existencia->fecha_hasta   = $fecha_hasta;
                        $existencia->tiposalida    = $tiposalida ;                
                        $existencia->documento_sal = $documento_sal   ;                
        
                        $existencia->save();

                        if ($tiposalida <> "FAC")  // si es una venta no se hace un registro de existencia nuevo
                        {

                        //Abrir existencia nueva
        
                        $existencia = new Existencia();
                        $existencia->inventario_id = $inventario_id  ;
                        $existencia->tipodoc       = $tiposalida ;
                        $existencia->documento     = $documento_sal ;
                        $existencia->deposito_id   = $deposito_id_to  ;
                        $existencia->fecha_desde   = $fecha_hasta ;
                        $existencia->save();                           

                            
                        }
        
 

                        return true ;  

            } catch(Exception $e){
            
            
              
                return false ;  
            } 


                      
    }



}
