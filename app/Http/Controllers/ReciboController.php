<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReciboRequest;
use App\Http\Requests\UpdateReciboRequest;
use App\Http\Controllers\AppBaseController;

use App\Models\Recibo;
use App\Models\Artesano;
use App\Models\Talonario;
use App\Models\Cheque;
use App\Models\RecibosLineas;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Carbon\Carbon;
use Auth;

include "funciones.php";


class ReciboController extends AppBaseController
{
    /**
     * Display a listing of the Recibo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexOld(Request $request)
    {
        /** @var Recibo $recibos */
        $recibos = Recibo::all();

        return view('recibos.index')
            ->with('recibos', $recibos);
    }



    public function index(Request $request)
    {

        $formulario  = $request->get('formulario');

        if($formulario)
        {        
            $recibos = DB::table('vw_recibos')
            ->where('formulario','like','%'.$formulario.'%' ) 
            ->paginate( 100 ) ;   

            $data['recibos'] = $recibos;     
            $data['formulario'] = $formulario;     

            Flash::success('Filtrando '.$formulario);            

            return view('recibos.index',["recibos"=>$recibos,"formulario"=>$formulario]);            
        } 
        else
        {
            //$inventarios = Inventario::all()->paginate(25);
            $recibos = DB::table('vw_recibos')->paginate(25);
        }
        return view('recibos.index')
            ->with('recibos', $recibos);
    }    



/**
     * Show the form for creating a new factura.
     *
     * @return Illuminate\View\View
     */
    public function preparar()
    {
   

             /*listar los productos en ventana modal*/
             $articulos=DB::table('tipopiezas as ar')
             ->select(DB::raw('CONCAT(ar.descrip," ",ar.tecnica) AS articulo'),'ar.id','ar.precio')
             ->get(); 

               /*listar los cheques en ventana modal*/
               $cheques=DB::table('cheques')
               ->select(DB::raw('CONCAT(numero," ->  ",  SUBSTR(fecha,9,2),"/",SUBSTR(fecha,6,2),"/",SUBSTR(fecha,1,4) ,"    Saldo -> $",saldo) AS chequedescrip'),'id')
               ->where( 'rendido_at','=', null )
               ->get();              

            //  /*listar los cheques en ventana modal*/
            //  $cheques=DB::table('cheques')
            //  ->select(DB::raw('CONCAT(numero," ",fecha, saldo) AS chequedescrip'),'id')
            //  ->get();    
             
           


             /*listar las clientes en ventana modal*/
             $artesanos=DB::table('artesanos')->get();     

             //PROXIMO NUMERO DE FORMULARIO
             //$ultimo_formulario = Recibo::latest()->first();

             $talonario = new Talonario;
             $proximo_recibo = $talonario->proximodocumento('REC');

             //dd($ultimo_formulario);

              
             $proximo_formulario = zeros($proximo_recibo,8);

            // Fecha por Default
            $mytime= Carbon::now('America/Argentina/Mendoza');
            $mytime= $mytime->toDateString();             





            $data['articulos'] = $articulos;     
            $data['cheques'] = $cheques;     
            $data['artesanos'] = $artesanos;     
            $data['nuevo_formulario'] = $proximo_formulario;     
            $data['fecha'] = $mytime;     
            $data['dni'] = '';     
        
        return view('recibos.preparar',$data );        

    }

    

    /**
     * Guardar recibo
     *
     * @param CreateReciboRequest $request
     *
     * @return Response
     */
    public function guardar(Request $request)
    {
        //$request->fecha

        //dd($request->fecha);
        $fecha_recibo = french2american( $request->fecha);

        //dd($request->id_cheque);

        //CONTROLAR EL SALDO DEL CHEQUE

        
        
        if( ! Cheque::TieneSaldoSuficiente($request->id_cheque,$request->total_pagar) )
        {
            Flash::error(' El Cheque seleccionado no tiene saldo suficiente' );                    
            return back()->withInput()
            ->withErrors('Saldo Insuficiente');       
        }



        try {

                $input = $request->all();
                


                $rules = [
                     'formulario' => 'required',
                     'fecha' => 'required',
                     //'artesano_id' => 'required'                                      
                ];
        
                
                $data = $request->validate($rules);
                //dd('$request->documento',$request->documento);

                //dd($data)    ;



                //Fecha
                $mytime= Carbon::now('America/Argentina/Mendoza');
                $mytime= $mytime->toDateString();
                //dd($mytime);

                //dd('$request->documento',$request->documento);
                //Traer datos del Artesano

                //\DB::enableQueryLog(); // Enable query log

                // Your Eloquent query executed by using get()
                $artesano = Artesano::where('documento', $request->documento  )->first();                 
                
                //dd(\DB::getQueryLog()); // Show results of log


                   

                if ( !$artesano ) {
                    // Handle error here
                    Flash::error('Seleccione el artesano' );                    
                    return back()->with('error', 'Seleccione el artesano');                    
                }   


                
                //datos a guardar en Recibo
                $recibo = new Recibo();
                $recibo->formulario =   $request->formulario; 
                $recibo->fecha = $fecha_recibo ;
                $recibo->artesano_id = $artesano->id ;
                $recibo->total = $request->total_pagar;
                //$recibo->cheque_id = 1 ;
                $recibo->rendido = 0 ;


                $recibo->cheque_id = $request->id_cheque ;


            
                //GUARDAR USUARIO
                $user = Auth::user();
                $recibo->user_name = $user->name ;
                $recibo->save();

                //GUARDAR RENGLONES DEL RECIBO
                $lineas_detalle = $request->_producto_id ; //Tomo el Id del Recibo insertado
                $cont=0;

                while($cont < count($lineas_detalle)){

                    $detalle = new RecibosLineas();
        
                    $detalle->recibo_id     = $recibo->id;
                    $detalle->tipopieza_id  = $request->_producto_id[$cont];
                    $detalle->cantidad      = $request->_cantidad[$cont];
                    $detalle->preciounit    = $request->_precio_venta[$cont];
                    $detalle->importe       = $request->_subtotal[$cont];
                    //$detalle->updated_at    = null ;
                    //$detalle->created_at    = $mytime ;
                    $detalle->save();
                    $cont=$cont+1;
                }


                //Actualizar Talonarios
                //cCadena = [update talonarios set proximodoc = '&cFormulario' +1 where tipo='REC' ]

                //Talonario::Actualizar('REC', $recibo->formulario) ;


                //$recibo->Actualizar('REC', $recibo->formulario) ;

                //$talonario = new Talonario();




                $talonario = new Talonario;
                $talonario->Actualizarproximodocumento('REC', $recibo->formulario );
   
                //dd($ultimo_formulario);







                // $tipo = 'REC';
                // $talonario = Talonario::where('tipo', $tipo)->first();
                // $UltimoDoc = $recibo->formulario;
                // $nProximoDoc = strval($UltimoDoc) + 1  ;
                // $talonario->proximodoc = $nProximoDoc;
                // $talonario->save();
                
            
                //** Grabar SAldo de cheque
                //cCadena = [update cheques set saldo = saldo - '&cTotal' where cheque = '&cCheque' ]	
                
                $cheque = new Cheque;
                $cheque->DescontarSaldo( $recibo->cheque_id , $recibo->total );

                Flash::success('Recibo guardado: ' . $recibo->formulario );

                return redirect(route('recibos.index'));


        } catch(Exception $e){
            
            
              


                $mensaje_error= $e->getMessage(); 
                Flash::error($mensaje_error );                    
                return back()->withInput()
                    ->withErrors([$mensaje_error]);
        }                  
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

        $talonario = Talonario::where('tipo', '==', $tipo)->firstOrFail();

        $nProximoDoc = strval($UltimoDoc) + 1  ;



        $talonario->proximodoc = $nProximoDoc;
        $talonario->save();

        

        return $nProximoDoc ;
    }





    /**
     * Show the form for creating a new Recibo.
     *
     * @return Response
     */
    public function create()
    {
        return view('recibos.create');
    }

    /**
     * Store a newly created Recibo in storage.
     *
     * @param CreateReciboRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {

        
        

        $input = $request->all();

        /** @var Recibo $recibo */
        $recibo = Recibo::create($input);

        Flash::success('Recibo saved successfully.');

        return redirect(route('recibos.index'));
    }
    

    /**
     * Display the specified Recibo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo no encontrado');

            return redirect(route('recibos.index'));
        }

        return view('recibos.show')->with('recibo', $recibo);
    }

    /**
     * Show the form for editing the specified Recibo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo no encontrado');

            return redirect(route('recibos.index'));
        }

        return view('recibos.edit')->with('recibo', $recibo);
    }

    /**
     * Update the specified Recibo in storage.
     *
     * @param int $id
     * @param UpdateReciboRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboRequest $request)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo no encontrado');

            return redirect(route('recibos.index'));
        }

        $recibo->fill($request->all());
        $recibo->save();

        Flash::success('Recibo actualizado');

        return redirect(route('recibos.index'));
    }

    /**
     * Remove the specified Recibo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo no encontrado');

            return redirect(route('recibos.index'));
        }

        $recibo->delete();

        Flash::success('Recibo borrado.');

        return redirect(route('recibos.index'));
    }
}


