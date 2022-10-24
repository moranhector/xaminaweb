<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRemitoRequest;
use App\Http\Requests\UpdateRemitoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Remito;
use App\Models\Remito_linea;
use App\Models\Existencia;
use App\Models\Talonario;
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

        return view('remitos.create',[
            "fecha_hoy"=>$fecha_hoy     
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
        //dd($request);

        try {

            $input = $request->all();

            //fecha al formato americano
            $fecha_remito = french2american( $request->fecha )  ;          

        


            $rules = [
                     'fecha' => 'required',

            ];


    
            
            $data = $request->validate($rules);
            //dd('$request->documento',$request->documento);

            if ($request->deposito_id_from == $request->deposito_id_to )
            {
                //dd('llega');

                throw new Exception('Depósitos no pueden ser iguales');
            }
            

  

            $remito = new Remito();
            $remito->fecha = $fecha_remito ;
            $remito->deposito_id_from = $request->deposito_id_from ;
            $remito->deposito_id_to = $request->deposito_id_to ;
            $remito->descrip = $request->remito_descrip ;
            $remito->user_name = "" ;

 
            
            $remito->save();
     

            //GUARDAR RENGLONES DEl REMITO
            $lineas_detalle = $request->_producto_id ; //Tomo el Id del ReMITO insertado
            $cont=0;

 

            while($cont < count($lineas_detalle)){

                $detalle = new Remito_linea();
    
                $detalle->remito_id      = $remito->id;
                $detalle->inventario_id  = $request->_producto_id[$cont];
                //$detalle->cantidad      = $request->_cantidad[$cont];

                //$detalle->updated_at    = null ;
                //$detalle->created_at    = $mytime ;
                $detalle->save();

                //Cerrar existencia anterior
                $existencia = new Existencia();                
                $existencia = Existencia::where('inventario_id', $detalle->inventario_id)
                ->where('fecha_hasta',null)
                ->first();
                $existencia->fecha_hasta   = now();
                $existencia->tiposalida    = "REMITO" ;                
                $existencia->documento_sal = $remito->id  ;                

                $existencia->save();

                //Abrir existencia nueva

                $existencia = new Existencia();
                $existencia->inventario_id = $detalle->inventario_id ;
                $existencia->tipodoc       = "REMITO" ;
                $existencia->documento     = $remito->id ;
                $existencia->deposito_id   = $remito->deposito_id_to ;
                $existencia->fecha_desde   = now() ;
                $existencia->save();





                $cont=$cont+1;
            }


 



            
        
            //** Grabar SAldo de cheque
            //cCadena = [update cheques set saldo = saldo - '&cTotal' where cheque = '&cCheque' ]	
            


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
