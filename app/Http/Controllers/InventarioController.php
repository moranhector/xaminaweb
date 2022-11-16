<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
include('funciones.php');

class InventarioController extends AppBaseController
{
    /**
     * Display a listing of the Inventario.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $namepieza  = $request->get('namepieza');

        if($namepieza)
        {        
            $inventarios = DB::table('inventarios')
            ->where('namepieza','like','%'.$namepieza.'%' ) 
            ->orWhere('npieza','like','%'.$namepieza.'%' ) 
            ->paginate( 25 ) ;   

            $data['inventarios'] = $inventarios;     
            $data['namepieza'] = $namepieza;     

            Flash::success('Filtrando '.$namepieza);            

            return view('inventarios.index',["inventarios"=>$inventarios,"namepieza"=>$namepieza]);            
        } 
        else
        {
            //$inventarios = Inventario::all()->paginate(25);
            $inventarios = DB::table('inventarios')->paginate(25);
        }
        return view('inventarios.index')
            ->with('inventarios', $inventarios);
    }




    public function ajax_pieza_deposito($pieza,$deposito)
    {
        
        
        //dd($pieza,$deposito);
        // http://localhost:8000/ajax_pieza_deposito/110484/1

        // $inventario = DB::table('inventarios')
        // ->where('npieza',$pieza ) 
        // ->get( ) ;   

        // SELECT * FROM inventarios  i 
        // INNER JOIN existencias e
        // ON i.id = e.inventario_id
        // WHERE i.id = 110484
        // AND e.fecha_hasta IS NULL

         
        //DB::enableQueryLog();

        $inventario = Inventario::join('existencias', 'inventarios.id', '=', 'existencias.inventario_id')
        ->where('inventarios.id', $pieza)
        ->where('existencias.fecha_hasta',NULL)
        ->get(['inventarios.*', 'existencias.deposito_id']);    
        
        //$query = DB::getQueryLog();

        //dd($query);

        

        //dd($inventario);

        $cantidadRegistros = $inventario->count();


        if ($cantidadRegistros  > 1 ) 
        {
            return Response::json(array(
                'code'      =>  200,
                'message'   =>  'Error: Se ha encontrado más de una pieza con ese número'
            ), 200);

        }


        switch ($cantidadRegistros) {
            case 0:
                return Response::json(array(
                        'code'      =>  200,
                        'message'   =>  'No se han encontrado piezas'
                    ), 200);

            case 1:
                //dd( empty( $inventario[0]->factura ) ) ;
                $vendida = empty( $inventario[0]->factura ) ? 'falso' : 'verdadero';

                if ( empty( $inventario[0]->factura ) ) 
                {

                    if ( $inventario[0]->deposito_id <> $deposito)
                    {
                        //dd($inventario[0]->deposito_id,$deposito);
                        return Response::json(array(    
                            'code'      =>  200,
                            'message'   =>  'Pieza en otro depósito: '.$inventario[0]->deposito_id,
                            'vendida'   =>  $vendida,
                          ), 200);                          

                    }

                    return Response::json(array(    
                        'code'      =>  200,
                        'message'   =>  'Pieza recuperada correctamente',
                        'vendida'   =>  $vendida,
                        'piezas'=>$inventario,
                    ), 200);  


                }
                else
                {
                return Response::json(array(    
                    'code'      =>  200,
                    'message'   =>  'Pieza vendida',
                    'vendida'   =>  $vendida,
                  ), 200);                  

                }
                 

        }



        // if $cantidadRegistros=1
        // {
        //     return response()->json([
        //         'piezas'=>$inventario,
        //     ]);
        // }

        // if $cantidadRegistros=0
        // {
        //     return response()->json([
        //         'piezas'=>$inventario,
        //     ]);
        // }        




    }







    // http://localhost:8000/fetch-pieza/090981
    // esto anda ok
    /// AJAX JQUERY DESDE Facturas





    public function fetchpieza($pieza)
    {
        
        
        //dd($pieza);

        $inventario = DB::table('inventarios')
        ->where('npieza',$pieza ) 
        ->get( ) ;   

        //dd($inventario[0]->factura);

        $cantidadRegistros = $inventario->count();


        if ($cantidadRegistros  > 1 ) 
        {
            return Response::json(array(
                'code'      =>  200,
                'message'   =>  'Error: Se ha encontrado más de una pieza con ese número'
            ), 200);

        }


        switch ($cantidadRegistros) {
            case 0:
                return Response::json(array(
                        'code'      =>  200,
                        'message'   =>  'No se han encontrado piezas'
                    ), 200);

            case 1:
                //dd( empty( $inventario[0]->factura ) ) ;
                $vendida = empty( $inventario[0]->factura ) ? 'falso' : 'verdadero';
                if ( empty( $inventario[0]->factura ) ) 
                {

                    return Response::json(array(    
                        'code'      =>  200,
                        'message'   =>  'Pieza recuperada correctamente',
                        'vendida'   =>  $vendida,
                        'piezas'=>$inventario,
                    ), 200);  


                }
                else
                {
                return Response::json(array(    
                    'code'      =>  200,
                    'message'   =>  'Pieza vendida',
                    'vendida'   =>  $vendida,
                  ), 200);                  

                }
                 

        }



        // if $cantidadRegistros=1
        // {
        //     return response()->json([
        //         'piezas'=>$inventario,
        //     ]);
        // }

        // if $cantidadRegistros=0
        // {
        //     return response()->json([
        //         'piezas'=>$inventario,
        //     ]);
        // }        




    }



    /**
     * Show the form for creating a new Inventario.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventarios.create');
    }

    /**
     * Store a newly created Inventario in storage.
     *
     * @param CreateInventarioRequest $request
     *
     * @return Response
     */
    public function store(CreateInventarioRequest $request)
    {
        $input = $request->all();

        /** @var Inventario $inventario */
        $inventario = Inventario::create($input);

        Flash::success('Inventario saved successfully.');

        return redirect(route('inventarios.index'));
    }

    /**
     * Display the specified Inventario.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Inventario $inventario */
        $inventario = Inventario::find($id);

        if (empty($inventario)) {
            Flash::error('Inventario not found');

            return redirect(route('inventarios.index'));
        }

        return view('inventarios.show')->with('inventario', $inventario);
    }

    /**
     * Show the form for editing the specified Inventario.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Inventario $inventario */
        $inventario = Inventario::find($id);

        if (empty($inventario)) {
            Flash::error('Inventario not found');

            return redirect(route('inventarios.index'));
        }

        return view('inventarios.edit')->with('inventario', $inventario);
    }

    /**
     * Update the specified Inventario in storage.
     *
     * @param int $id
     * @param UpdateInventarioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventarioRequest $request)
    {
        /** @var Inventario $inventario */
        $inventario = Inventario::find($id);

        if (empty($inventario)) {
            Flash::error('Inventario not found');

            return redirect(route('inventarios.index'));
        }

        $inventario->fill($request->all());
        $inventario->save();

        Flash::success('Inventario updated successfully.');

        return redirect(route('inventarios.index'));
    }

    /**
     * Remove the specified Inventario from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Inventario $inventario */
        $inventario = Inventario::find($id);

        if (empty($inventario)) {
            Flash::error('Inventario not found');

            return redirect(route('inventarios.index'));
        }

        $inventario->delete();

        Flash::success('Inventario deleted successfully.');

        return redirect(route('inventarios.index'));
    }


    /**
     * Display a listing of the Inventario.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function inventario_fecha(Request $request)
    {

      
        

        $fecha_hasta  = $request->get('fecha_hasta');


        if( !$fecha_hasta )   //IF NOT FECHA_HASTA
        {       
             //Si no viene la fecha la ponemos por defecto

            $mytime= Carbon::now('America/Argentina/Mendoza');
            $hoy= $mytime->toDateString();               
            $fecha_hasta = $hoy;
      


        }
        // Paso la fecha a Frances
        $fecha_hasta_french = american2frech( $fecha_hasta)  ; 
        $namepieza  = $request->get('namepieza');

        
        if ($namepieza)
        {
            $filtroPorPieza = " namepieza like '%$namepieza%' and ";

        }
        else
        {
            $filtroPorPieza = ' ';
            $namepieza ='';
        }


        $cSelect =    
        "SELECT * FROM inventarios 
        WHERE $filtroPorPieza      
        comprado_at <= '$fecha_hasta'
        AND ( vendido_at IS NULL OR vendido_at > '$fecha_hasta' )";    
        
        $cSelect = 
        "SELECT i.id,i.codigo12,i.npieza, i.namepieza,i.tipopieza_id,t.descrip,i.precio,i.costo, i.comprado_at FROM inventarios i     
        INNER JOIN tipopiezas t
        ON i.tipopieza_id = t.id 
        WHERE $filtroPorPieza      
        comprado_at <= '$fecha_hasta'
        AND ( vendido_at IS NULL OR vendido_at > '$fecha_hasta' )";  

 
        $inventarios = collect(  DB::select(DB::raw($cSelect)) ) ->paginate(100);                         

        $data['inventarios'] = $inventarios;     
        $data['namepieza'] = $namepieza;     

    
        Flash::success('Inventario a fecha: '.$fecha_hasta_french.'  Piezas: '.$namepieza);             

        return view('inventarios.inventario_fecha',["inventarios"=>$inventarios,"namepieza"=>$namepieza]);            
 
    }    


}
