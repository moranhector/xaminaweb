<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRemitoRequest;
use App\Http\Requests\UpdateRemitoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Remito;
use App\Models\Remito_linea;
use App\Models\Existencia;
use App\Models\Talonario;
use App\Models\Deposito;
use Illuminate\Http\Request;
use Flash;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

include "funciones.php";

class RemitoController extends AppBaseController
{
    /**
     * Display a listing of the Remito.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index_original(Request $request)
    {
        /** @var Remito $remitos */
        $remitos = Remito::all();

        return view('remitos.index')
            ->with('remitos', $remitos);
    }

    public function index(Request $request)
    {
    
        $descrip  = $request->get('descrip');
    
        if($descrip)
        {        

            $remitos = DB::table('remitos')
            ->join('depositos as d1', 'remitos.deposito_id_from', '=', 'd1.id')
            ->join('depositos as d2', 'remitos.deposito_id_to', '=', 'd2.id')
            ->select('remitos.id', 'descrip', 'fecha', 'deposito_id_from', 'd1.nombre AS deposito_desde', 'deposito_id_to', 'd2.nombre AS deposito_hacia', 'cantidad')
            ->where('descrip','like','%'.$descrip.'%' ) 
            ->paginate( 100 ) ;   
    
     
            $data['descrip'] = $descrip;     
    
            Flash::success('Filtrando '.$descrip);            
    
            return view('remitos.index',["remitos"=>$remitos,"descrip"=>$descrip]);            
        } 
        else
        {

            $remitos = DB::table('remitos')
            ->join('depositos as d1', 'remitos.deposito_id_from', '=', 'd1.id')
            ->join('depositos as d2', 'remitos.deposito_id_to', '=', 'd2.id')
            ->select('remitos.id', 'descrip', 'fecha', 'deposito_id_from', 'd1.nombre AS deposito_desde', 'deposito_id_to', 'd2.nombre AS deposito_hacia', 'cantidad')
            ->paginate( 25 ) ;              
            
           
        }
        return view('remitos.index')
            ->with('remitos', $remitos);
    }   




    /**
     * Show the form for creating a new Remito.
     *
     * @return Response
     */
    public function create()
    {
        //$fecha_hoy = $date->format('d/m/Y');
        $fecha_hoy = Carbon::now('America/Argentina/Mendoza');
        $fecha_hoy= $fecha_hoy->format('d/m/Y');   
        //dd($mytime);

             /*listar los deposito en dropdown*/
             $depositos= Deposito::all();        

        return view('remitos.create',[
            "fecha_hoy"=>$fecha_hoy ,    
            "depositos"=>$depositos               
            ]);
    }



    /**
     * Store a newly created Remito in storage.
     *
     * @param CreateRemitoRequest $request
     *
     * @return Response
     */
    public function store(CreateRemitoRequest $request)
    {
        //dd($request->request);

        // "deposito_id_from" => "CENTRAL"
        // "id_deposito_1" => "1"
        // "deposito_id_to" => "CENTRAL"
        // "id_deposito_2" => "1"


         // Primero reviso si vienen piezas duplicadas, en Javascript es más difícil controlar

         if( hayDuplicados( $request->_producto_id ))  //Función en Funciones.php
         {
            $mensaje_error= 'Piezas repetidas en Remito - No se pudo Grabar - Por favor vuelva a cargar'; 
            Flash::error($mensaje_error );                    
            return back()->withInput();                     
         }      
         
        //  $mensaje_error= 'ESTUVO OK'; 
        //  Flash::error($mensaje_error );                    
        //  return back()->withInput();                    


        try {
            


            DB::beginTransaction();  //to start transaction.            

            $input = $request->all();

            //fecha al formato americano
            $fecha_remito = french2american( $request->fecha )  ;          

            $rules = [
                     'fecha' => 'required',
            ];
            
            $data = $request->validate($rules);

            $remito = new Remito();
            $remito->fecha = $fecha_remito ;
            $remito->deposito_id_from = $request->id_deposito_1 ;
            $remito->deposito_id_to = $request->id_deposito_2;
            $descrip = empty($request->remito_descrip ) ? 'S/D' : $request->remito_descrip;
            $remito->descrip = $descrip ;
            $remito->user_name = "" ;           
            $remito->save();
     

            //GUARDAR RENGLONES DEl REMITO
            $lineas_detalle = $request->_producto_id ; //Tomo el Id del ReMITO insertado
            $cont=0;

            

            while($cont < count($lineas_detalle)){


                

                $detalle = new Remito_linea();
    
                $detalle->remito_id      = $remito->id;
                $detalle->inventario_id  = $request->_inventario_id[$cont];
                //$detalle->cantidad      = $request->_cantidad[$cont];

                //$detalle->updated_at    = null ;
                //$detalle->created_at    = $mytime ;
                $detalle->save();

                if ( ! Existencia::Actualizar( $detalle->inventario_id, 
                    $remito->deposito_id_from,
                    $fecha_remito ,
                    'REMITO' ,
                    zeros($remito->id,8), $remito->deposito_id_to  ) )
                    //SI NO PUEDE ACTUALZIAR REGRESARA CON LOS ERRORES
                    {
                    //DB::rollBack(); // after each error.            
                    $mensaje_error= 'PROBLEMAS DE EXISTENCIA'; 
                    Flash::error($mensaje_error );                    
                    return back()->withInput();                                                
                    }                                            ;                

                 $cont=$cont+1;
            }

            DB::commit(); //CONFIRMO TRANSACCION REMITO ;

            Flash::success('Remito guardado: ' . $remito->id );

            return redirect(route('remitos.index'));


    } catch(Exception $e){
        
        
          


            $mensaje_error= $e->getMessage(); 
            Flash::error($mensaje_error );                    
            return back()->withInput()
                ->withErrors([$mensaje_error]);
    }                  
}
     
    



    /**
     * Display the specified Remito.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Remito $remito */
        $remito = Remito::find($id);

        if (empty($remito)) {
            Flash::error('Remito not found');

            return redirect(route('remitos.index'));
        }

        return view('remitos.show')->with('remito', $remito);
    }

    /**
     * Show the form for editing the specified Remito.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Remito $remito */
        $remito = Remito::find($id);

        if (empty($remito)) {
            Flash::error('Remito not found');

            return redirect(route('remitos.index'));
        }

        return view('remitos.edit')->with('remito', $remito);
    }

    /**
     * Update the specified Remito in storage.
     *
     * @param int $id
     * @param UpdateRemitoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRemitoRequest $request)
    {
        /** @var Remito $remito */
        $remito = Remito::find($id);

        if (empty($remito)) {
            Flash::error('Remito not found');

            return redirect(route('remitos.index'));
        }

        $remito->fill($request->all());
        $remito->save();

        Flash::success('Remito updated successfully.');

        return redirect(route('remitos.index'));
    }

    /**
     * Remove the specified Remito from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Remito $remito */
        $remito = Remito::find($id);

        if (empty($remito)) {
            Flash::error('Remito not found');

            return redirect(route('remitos.index'));
        }

        $remito->delete();

        Flash::success('Remito deleted successfully.');

        return redirect(route('remitos.index'));
    }
}
