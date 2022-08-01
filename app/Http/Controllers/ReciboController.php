<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReciboRequest;
use App\Http\Requests\UpdateReciboRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Recibo;
use App\Models\RecibosLineas;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Carbon\Carbon;
use Auth;


class ReciboController extends AppBaseController
{
    /**
     * Display a listing of the Recibo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Recibo $recibos */
        $recibos = Recibo::all();

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
   
            //dd('entro');    
             /*listar los productos en ventana modal*/
             $articulos=DB::table('tipopiezas as ar')
             ->select(DB::raw('CONCAT(ar.descrip," ",ar.tecnica) AS articulo'),'ar.id','ar.precio')
             ->get(); 

             /*listar las clientes en ventana modal*/
             //$clientes=DB::table('clientes')->get();     
             $artesanos=DB::table('artesanos')->get();     


             //Factura Electrónica
               $dni = "18083471";
             //$MODO = 0;
             //$afip = new wsfev1($CUIT,$MODO);
             //$result = $afip->consultarUltimoComprobanteAutorizado(1, 1);

             //$nTipoFactura = TipoFacturaAfip($tipofactura) ; //Obtengo el código numérico



             //$result = $afip->consultarUltimoComprobanteAutorizado(1,$nTipoFactura);             
             //$nueva_factura = $result +1 ;     
             $nuevo_formulario = zeros('1',8)   ;     

             //$factura = new Factura();
             //$factura->ptovta = '0001';

        $mytime= Carbon::now('America/Argentina/Mendoza');
        $mytime= $mytime->toDateString();             


        $data['articulos'] = $articulos;     
        $data['artesanos'] = $artesanos;     
        $data['nuevo_formulario'] = $nuevo_formulario;     
        $data['fecha'] = $mytime;     
        $data['dni'] = $dni;     
        
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
        $input = $request->all();
        //dd($input);

        $mytime= Carbon::now('America/Argentina/Mendoza');
        $mytime= $mytime->toDateString();
        //dd($mytime);
  
        $recibo = new Recibo();
        
        $recibo->formulario =   $request->formulario; 
        $recibo->fecha = $request->fecha ;
        $recibo->artesano_id = 2 ;
        $recibo->total = 0 ;
        $recibo->cheque_id = 1 ;
        $recibo->rendido = 0 ;
        $recibo->total = 0 ;
        //GUARDAR USUARIO
        $user = Auth::user();
        $recibo->user_name = $user->name ;
        $recibo->save();


        $lineas_detalle = $request->_producto_id ;
        $cont=0;

        while($cont < count($lineas_detalle)){

            $detalle = new RecibosLineas();
            //dd($detalle);
            /*enviamos valores a las propiedades del objeto detalle*/
            /*al idcompra del objeto detalle le envio el id del objeto venta, que es el objeto que se ingresó en la tabla ventas de la bd*/
            /*el id es del registro de la venta*/
            $detalle->recibo_id     = $recibo->id;
            $detalle->tipopieza_id  = $request->_producto_id[$cont];
            $detalle->cantidad      = $request->_cantidad[$cont];
            $detalle->preciounit    = $request->_precio_venta[$cont];
            $detalle->importe       = 0;
            //$detalle->updated_at    = null ;
            //$detalle->created_at    = $mytime ;
            //$detalle->total         = 0;

            // 'recibo_id' => 'integer',
            // 'tipopieza_id' => 'integer',
            // 'cantidad' => 'integer',
            // 'preciounit' => 'decimal:2',
            // 'importe' => 'decimal:2'            

            $detalle->save();

            $cont=$cont+1;
        }




        //dd($request->all());

        /** @var Recibo $recibo */
        //$recibo = Recibo::create($input);

        Flash::success('Recibo saved successfully.');

        return redirect(route('recibos.index'));
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
            Flash::error('Recibo not found');

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
            Flash::error('Recibo not found');

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
            Flash::error('Recibo not found');

            return redirect(route('recibos.index'));
        }

        $recibo->fill($request->all());
        $recibo->save();

        Flash::success('Recibo updated successfully.');

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
            Flash::error('Recibo not found');

            return redirect(route('recibos.index'));
        }

        $recibo->delete();

        Flash::success('Recibo deleted successfully.');

        return redirect(route('recibos.index'));
    }
}

///// FUNCIONES GENERALES FUERA DE LA CLASE

function Fecha()
{

    $date = Carbon::today();
    $fecha = $date->format('Ymd');   
    // Esto debe devolver AAAAMMDD por ejemplo  "20190909"

    //dd($fecha);

    echo $fecha;
    return $fecha;
}

function zeros($cadena,$longitud)
{

    $zeros =  substr("00000000".$cadena,-1 * $longitud ,$longitud);
    //dd($zeros);
    return $zeros;
}

////////////////////////////////////////////
