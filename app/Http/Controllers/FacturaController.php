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

             $cSelect = 
             "SELECT i.id, i.codigo12, i.npieza,i.namepieza,i.precio FROM inventarios i
             INNER JOIN existencias e
             ON i.id = e.inventario_id
             WHERE i.vendido_at IS NULL
             AND e.deposito_id = 1";
     
     
             //dd($cCuit);
             $articulos = DB::select(DB::raw($cSelect));




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


        
        return view('facturas.preparar',[
            "clientes"=>$clientes,
            "articulos"=>$articulos,
            "nueva_factura"=>$nueva_factura,      
            "fecha"=>$fecha_hoy     
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

        //dd($request);

        try {

                $input = $request->all();
                //dd($input);


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

                $fecha_factura = french2american( $request->fecha )  ;    

                $factura->fecha = $fecha_factura ;
                $factura->cliente_id = $cliente->id ;
                $factura->total = $request->total_pagar;
                
                

            
                //GUARDAR USUARIO
                // $user = Auth::user();
                // $recibo->user_name = $user->name ;
                
                $factura->save();

                //GUARDAR RENGLONES DE LA FACTURA
                $lineas_detalle = $request->_producto_id ; //Tomo el Id del Recibo insertado
                $cont=0;

                while($cont < count($lineas_detalle)){

                    $detalle = new Faclinea();
        
                    $detalle->factura_id     = $factura->id;
                    $detalle->inventario_id  = $request->_producto_id[$cont];
                    //$detalle->cantidad      = $request->_cantidad[$cont];
                    $detalle->cantidad      = 1 ;
                    $detalle->preciounit    = $request->_precio_venta[$cont];
                    $detalle->importe       = $request->_subtotal[$cont];
                    //$detalle->updated_at    = null ;
                    //$detalle->created_at    = $mytime ;
                    $detalle->save();
                    $cont=$cont+1;
                }

 




                $talonario = new Talonario;
                $talonario->Actualizarproximodocumento('FAC', $factura->formulario );
   
                //dd($ultimo_formulario);







                // $tipo = 'REC';
                // $talonario = Talonario::where('tipo', $tipo)->first();
                // $UltimoDoc = $recibo->formulario;
                // $nProximoDoc = strval($UltimoDoc) + 1  ;
                // $talonario->proximodoc = $nProximoDoc;
                // $talonario->save();
                
            
                //** Grabar SAldo de cheque
                //cCadena = [update cheques set saldo = saldo - '&cTotal' where cheque = '&cCheque' ]	
                
 

                Flash::success('Factura guardada: ' . $factura->formulario );

                return redirect(route('facturas.index'));


        } catch(Exception $e){
            
            
              


                $mensaje_error= $e->getMessage(); 
                Flash::error($mensaje_error );                    
                return back()->withInput()
                    ->withErrors([$mensaje_error]);
        }                  
    }

}
