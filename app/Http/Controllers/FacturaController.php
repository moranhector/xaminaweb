<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Faclinea;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\DB;
use App\Models\Talonario;
use App\Models\Existencia;
use App\Models\Inventario;
use App\Models\Deposito;
use Carbon\Carbon;
include "funciones.php";

class FacturaController extends AppBaseController
{
    /**
     * Display a listing of the Factura.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Factura $facturas */
        $facturas = Factura::all();

        return view('facturas.index')
            ->with('facturas', $facturas);
    }

    /**
     * Show the form for creating a new Factura.
     *
     * @return Response
     */
    public function create()
    {
        return view('facturas.create');
    }

    /**
     * Store a newly created Factura in storage.
     *
     * @param CreateFacturaRequest $request
     *
     * @return Response
     */
    public function store(CreateFacturaRequest $request)
    {
        $input = $request->all();

        /** @var Factura $factura */
        $factura = Factura::create($input);

        Flash::success('Factura saved successfully.');

        return redirect(route('facturas.index'));
    }

    /**
     * Display the specified Factura.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Factura $factura */
        $factura = Factura::find($id);

        if (empty($factura)) {
            Flash::error('Factura not found');

            return redirect(route('facturas.index'));
        }

        return view('facturas.show')->with('factura', $factura);
    }

    /**
     * Show the form for editing the specified Factura.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Factura $factura */
        $factura = Factura::find($id);

        if (empty($factura)) {
            Flash::error('Factura not found');

            return redirect(route('facturas.index'));
        }

        return view('facturas.edit')->with('factura', $factura);
    }

    /**
     * Update the specified Factura in storage.
     *
     * @param int $id
     * @param UpdateFacturaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacturaRequest $request)
    {
        /** @var Factura $factura */
        $factura = Factura::find($id);

        if (empty($factura)) {
            Flash::error('Factura not found');

            return redirect(route('facturas.index'));
        }

        $factura->fill($request->all());
        $factura->save();

        Flash::success('Factura updated successfully.');

        return redirect(route('facturas.index'));
    }

    /**
     * Remove the specified Factura from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Factura $factura */
        $factura = Factura::find($id);

        if (empty($factura)) {
            Flash::error('Factura not found');

            return redirect(route('facturas.index'));
        }

        $factura->delete();

        Flash::success('Factura deleted successfully.');

        return redirect(route('facturas.index'));
    }

    /**
     * Show the form for creating a new factura.
     *
     * @return Illuminate\View\View
     */
    public function preparar()
    {
   

             /*listar los artículos a vender*/

            //  $cSelect = 
            //  "SELECT i.id, i.codigo12, i.npieza,i.namepieza,i.precio FROM inventarios i
            //  INNER JOIN existencias e
            //  ON i.id = e.inventario_id
            //  WHERE i.vendido_at IS NULL
            //  AND e.deposito_id = 1";
     
     
            //  //dd($cCuit);
            //  $articulos = DB::select(DB::raw($cSelect));




             /*listar las clientes en ventana modal*/
             $clientes=DB::table('clientes')->get();     

             //Factura Electrónica
             $CUIT = "32999999999";

             //PROXIMO NUMERO DE FORMULARIO
             //$ultimo_formulario = Recibo::latest()->first();
             $talonario = new Talonario;
             $nueva_factura = $talonario->proximodocumento('FAC');      
                          

             //dd($ultimo_formulario);

     

            // Fecha por Default
 

            $fecha_hoy = Carbon::now('America/Argentina/Mendoza');
            $fecha_hoy= $fecha_hoy->format('d/m/Y');   
            //dd($mytime);

             /*listar los deposito en dropdown*/
             $depositos= Deposito::all();


        
        return view('facturas.preparar',[
            "clientes"=>$clientes,
            // "articulos"=>$articulos,
            "nueva_factura"=>$nueva_factura,      
            "fecha"=>$fecha_hoy,    
            "depositos"=>$depositos,    
            ]);        

    }

  /**
     * Guardar Factura
     *
     *  
     *  
     */
    public function guardar(Request $request)
    {

        //dd( $request->request );

         // Primero reviso si vienen piezas duplicadas, en Javascript es más difícil controlar

         if( hayDuplicados( $request->_pieza ))  //Función en Funciones.php
         {
            $mensaje_error= 'Piezas repetidas en Factura - No se pudo Grabar - Por favor vuelva a cargar'; 
            Flash::error($mensaje_error );                    
            return back()->withInput();                     
         }      
         
        //  $mensaje_error= 'ESTUVO OK'; 
        //  Flash::error($mensaje_error );                    
        //  return back()->withInput();            

    


        // +request: Symfony\Component\HttpFoundation\InputBag {#44 ▼
        //     #parameters: array:17 [▼
        //       "_token" => "KHEEq7CmjXZ0yCCiHwTvkENpJKyDlEdrZVn4mgEj"
        //       "deposito" => "CENTRAL"
        //       "documento" => "18083471"
        //       "cliente_nombre" => "CONSUMIDOR FINAL"
        //       "formulario" => "11"
        //       "fecha" => "20/11/2022"
        //       "id_inventario" => null
        //       "pieza" => null
        //       "descrip" => null
        //       "precio_venta" => null
        //       "total_pagar" => "130.00"
        //       "_inventario_id" => array:1 [▼
        //         0 => "1"
        //       ]
        //       "_pieza" => array:1 [▼
        //         0 => "200080"
        //       ]
        //       "_descrip" => array:1 [▼
        //         0 => "VINCHA P/ SOMBRERO SIMPLE"
        //       ]
        //       "_precio_venta" => array:1 [▼
        //         0 => "130.00"
        //       ]
        //       "_subtotal" => array:1 [▼
        //         0 => "130.00"
        //       ]
        //       "id_deposito" => "1"        


        $deposito_id = $request->id_deposito ; //Depósito seleccionado del formulario.

        try {


                DB::beginTransaction();  //to start transaction.


            

                $input = $request->all();
                //dd($input);


                $rules = [
                     'formulario' => 'required',
                     'fecha' => 'required',
                     'cliente_nombre' => 'required',
                     //'artesano_id' => 'required'                                      
                ];
        
                
                $data = $request->validate($rules);
                //dd('$request->documento',$request->documento);

                //dd($data)    ;



                //Fecha
                $mytime= Carbon::now('America/Argentina/Mendoza');
                $mytime= $mytime->toDateString();
                //dd($mytime);

 

                //\DB::enableQueryLog(); // Enable query log

                // Your Eloquent query executed by using get()
                $cliente = Cliente::where('documento', $request->documento  )->first();                 
                 
                if ( !$cliente ) {
                    // Handle error here
                    //Flash::error('Seleccione el cliente' );                    
                    //return back()->with('error', 'Seleccione el cliente');                    
                    $cliente = new Cliente();
                    $cliente->nombre    = $request->cliente_nombre;
                    $cliente->documento = $request->documento;
                    $cliente->ivacond   = "CONSUMIDOR FINAL";
                    $cliente->save();
                    
                }   

        
                
                //datos a guardar en Recibo
                $factura = new Factura();
                $factura->formulario =   $request->formulario; 
                $factura->ptovta =  '1' ; 
                $factura->tipo =  'FACB' ; 
                $factura->ivacond=  "CONSUMIDOR FINAL" ; 
                $factura->domicilio=  " " ; 
                $factura->telefono=  " " ; 
                $factura->email=  " " ; 
                $factura->tipodoc=  " " ; 
                $factura->documento=  " " ; 

                $fecha_factura = french2american( $request->fecha )  ;    

                $factura->fecha = $fecha_factura ;
                $factura->cliente_id = $cliente->id ;
                $factura->total = $request->total_pagar;
                
                

            
                //GUARDAR USUARIO
                // $user = Auth::user();
                // $recibo->user_name = $user->name ;
                
                $factura->save();

                //GUARDAR RENGLONES DE LA FACTURA
                $cant_lineas_detalle = $request->_inventario_id ; //Tomo el Id del Recibo insertado
                $cont=0;

                while($cont < count($cant_lineas_detalle)){

                    $detalle = new Faclinea();
        
                    $detalle->factura_id     = $factura->id;
                    $detalle->inventario_id  = $request->_inventario_id[$cont];
           
                    $detalle->cantidad      = 1 ;
                    $detalle->preciounit    = $request->_precio_venta[$cont];
                    $detalle->importe       = $request->_subtotal[$cont];
                    //$detalle->updated_at    = Se actualiza sola por el módulo
                    //$detalle->created_at    = Se actualiza sola por el módulo
                    $detalle->save();
                    $cont=$cont+1;
                }

 
                // Actualizar Existencia 18/11/2022    
                $cont=0;                
                while($cont < count($cant_lineas_detalle)){


                    if ( ! Existencia::Actualizar( $request->_inventario_id[$cont], 
                                             $deposito_id,
                                             $fecha_factura ,
                                             'FAC' ,
                                             $factura->formulario   ) )
                                             //SI NO PUEDE ACTUALZIAR REGRESARA CON LOS ERRORES
                                             {
                                                DB::rollBack(); // after each error.            
                                                $mensaje_error= 'PROBLEMAS DE EXISTENCIA'; 
                                                Flash::error($mensaje_error );                    
                                                return back()->withInput();                                                
                                             }                                            ;

                    //Actualizar INVENTARIO Grabar Factura,  vendido_at,    
                    
                    $inventario = Inventario::find(  $request->_inventario_id[$cont] );

                    $inventario->factura = $factura->formulario ;
                    $inventario->factura_id = $factura->formulario ;
                    $inventario->vendido_at = $fecha_factura ;
                    $inventario->save();

                    $cont=$cont+1;
                }

                $talonario = new Talonario;
                $talonario->Actualizarproximodocumento('FAC', $factura->formulario );
                
                DB::commit(); //CONFIRMO TRANSACCION FACTURA ;

                Flash::success('Factura guardada: ' . $factura->formulario );

                return redirect(route('facturas.index'));


        } catch(Exception $e){
            
                DB::rollBack(); // after each error.
              


                $mensaje_error= $e->getMessage(); 
                Flash::error($mensaje_error );                    
                return back()->withInput()
                    ->withErrors([$mensaje_error]);
        }                  
    }

}
