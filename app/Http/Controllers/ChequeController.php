<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChequeRequest;
use App\Http\Requests\UpdateChequeRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Cheque;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;


use App\Models\Talonario;
use App\Models\Inventario;
use App\Models\Rendicion;
use Mpdf\Mpdf;
include 'funciones.php';

class ChequeController extends AppBaseController
{
    /**
     * Display a listing of the Cheque.
     *
     * @param Request $request
     *
     * @return Response
     */
    // public function index(Request $request)
    // {
    //     /** @var Cheque $cheques */
    //     $cheques = Cheque::all();

    //     return view('cheques.index')
    //         ->with('cheques', $cheques);
    // }

    public function index(Request $request)
    {

        $numero  = $request->get('numero');

        if($numero)
        {        
            $cheques = DB::table('cheques')
            ->where('numero','like','%'.$numero.'%' ) 
            ->paginate( 100 ) ;   

            $data['cheques'] = $cheques;     
            $data['numero'] = $numero;     

            Flash::success('Filtrando '.$numero);              

            return view('cheques.index',["cheques"=>$cheques,"numero"=>$numero]);            
        } 
        else
        {
            //$cheques = Inventario::all()->paginate(25);
            $cheques = DB::table('cheques')->paginate(25);
        }
        return view('cheques.index')
            ->with('cheques', $cheques);
    }
    


    /**
     * Show the form for creating a new Cheque.
     *
     * @return Response
     */
    public function create()
    {
        // DECLARO OBJETO TALONARIO QUE SIRVE PARA NUMERAR CHEQUES, FACTURAS, RECIBOS, ETC
        $talonario = new Talonario;

        //acá tomo el próximo número de cheque

        $proximo_numero = $talonario->proximodocumento('CHEQUE');      
        $data['proximo_numero'] = $proximo_numero;     


        //acá tomo el número de cuenta bancaria
        $cuenta_banco = $talonario->proximodocumento('CUENTA BANCO');      
        $data['cuenta_banco'] = $cuenta_banco;           
        

        
        return view('cheques.create',$data);
    }

    /**
     * Store a newly created Cheque in storage.
     *
     * @param CreateChequeRequest $request
     *
     * @return Response
     */
    public function store(CreateChequeRequest $request)
    {
        $input = $request->all();

        $dfecha = substr($request->fecha,6,4).'-'.substr($request->fecha,3,2).'-'.substr($request->fecha,0,2);

        //dd($dfecha);

        

        try {        

            $cheque = new Cheque();
            $cheque->numero = $request->numero;
            $cheque->fecha = $dfecha;
            
            //$cheque->fecha = $request->fecha;
            $cheque->importe = $request->importe;
            $cheque->ncuenta = $request->ncuenta;
            //dd($input);
            $cheque->saldo   = $request->importe;
            $cheque->depositado   = 0;

            


            //\DB::enableQueryLog(); // Enable query log

            $cheque->save();
      
            //dd(\DB::getQueryLog()); // Show results of log


            $talonario = new Talonario;
            $talonario->Actualizar('CHEQUE', $cheque->numero );            


            /** @var Cheque $cheque */
            //$cheque = Cheque::create($input);

            Flash::success('Cheque grabado correctamente.');

            return redirect(route('cheques.index'));
        

        } catch(Exception $e){

            $mensaje_error= $e->getMessage(); 
            Flash::error($mensaje_error );                    
            return back()->withInput()
                ->withErrors([$mensaje_error]);
        }            




    }

    /**
     * Display the specified Cheque.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Cheque $cheque */
        $cheque = Cheque::find($id);

        if (empty($cheque)) {
            Flash::error('Cheque no encontrado');

            return redirect(route('cheques.index'));
        }

        return view('cheques.show')->with('cheque', $cheque);
    }




    /**
     * Show the form for editing the specified Cheque.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Cheque $cheque */
        $cheque = Cheque::find($id);

        if (empty($cheque)) {
            Flash::error('Cheque no encontrado');

            return redirect(route('cheques.index'));
        }

        return view('cheques.edit')->with('cheque', $cheque);
    }

    /**
     * Update the specified Cheque in storage.
     *
     * @param int $id
     * @param UpdateChequeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChequeRequest $request)
    {
        /** @var Cheque $cheque */
        $cheque = Cheque::find($id);

        if (empty($cheque)) {
            Flash::error('Cheque no encontrado');

            return redirect(route('cheques.index'));
        }

        $cheque->fill($request->all());
        $cheque->save();

        Flash::success('Cheque actualizado correctamente.');

        return redirect(route('cheques.index'));
    }

    /**
     * Remove the specified Cheque from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function Olddestroy($id)
    {
        /** @var Cheque $cheque */
        $cheque = Cheque::find($id);
        $numero_cheque = $cheque->numero;

        if (empty($cheque)) {
            Flash::error('Cheque no encontrado');

            return redirect(route('cheques.index'));
        }

        // si está rendido, no se puede eliminar 
        // Si tiene compras ya registradas no se puede eliminar 

       

        $cheque->delete();

        $user = Auth::user();

        $cheque->user_name = $user->name;

 
        $cheque->save();


        $cheque->save();
        Flash::success('Cheque '.$numero_cheque.' eliminado.');

        return redirect(route('cheques.index'));
    }


    public function destroy($id)
    {
        /** @var Cheques $cheque */
        $cheque = Cheque::find($id);

        if (empty($cheque)) {
            Flash::error('Cheques no encontrado');

            return redirect(route('cheques.index'));
        }


        $recibosr = DB::table('recibos_lineas as rr')
        ->join('recibos as r', 'rr.recibo_id', '=', 'r.id')
        ->join('tipopiezas as p', 'rr.tipopieza_id', '=', 'p.id')
        ->join('artesanos as a', 'r.artesano_id', '=', 'a.id')
        ->select('r.id','r.cheque_id','r.formulario', 'r.artesano_id',  'rr.tipopieza_id', 'rr.cantidad', 'rr.preciounit', 
        'rr.importe', 'p.descrip','p.tecnica','p.precio','a.nombre', 'rr.tipopieza_id as inventario' )
        ->whereRaw('cheque_id = ?', $id) 
        ->get();        

        $reccount = $recibosr->count();

        if( $reccount > 0 )
        {
            Flash::error('Cheques no puede anularse. Tiene compras pendientes de rendición');

            return redirect(route('cheques.index'));

        }

        $cheque->delete();

        Flash::success('Cheques borrado correctamente.');

        return redirect(route('cheques.index'));
    }
    



    /**
     * Display the specified Cheque.
     *
     * @param int $id
     *
     * @return Response
     */
    public function rendir($id)
    {


        
        /** @var Cheque $cheque */
        $cheque = Cheque::find($id);

        if (empty($cheque)) {
            Flash::error('Cheque no encontrado');

            return redirect(route('cheques.index'));
        }

        /*listar las piezas a rendir*/

        $recibosr = DB::table('recibos_lineas as rr')
        ->join('recibos as r', 'rr.recibo_id', '=', 'r.id')
        ->join('tipopiezas as p', 'rr.tipopieza_id', '=', 'p.id')
        ->join('artesanos as a', 'r.artesano_id', '=', 'a.id')
        ->select('r.id','r.cheque_id','r.formulario', 'r.artesano_id',  'rr.tipopieza_id', 'rr.cantidad', 'rr.preciounit', 
        'rr.importe', 'p.descrip','p.tecnica','p.precio','a.nombre', 'rr.tipopieza_id as inventario' )
        ->whereRaw('cheque_id = ?', $id) 
        ->get();

 

        $reccount = $recibosr->count();

 

        $renglones = collect() ;

        //dd($renglones);

        // https://www.youtube.com/watch?v=HWQv5WWojfg&list=PLBli5uT0LXytLdgsEzHqTKJCBjQAmXGkh&index=2
        // Refactorizar 

        
        
        // Multiplicar los renglones que tienen cantidad > 1
        $nRenglon = 0;
        foreach ($recibosr as $recibos) {
       
            for ($i = 1; $i <= $recibos->cantidad ; $i++) {
                
                $registro = $recibosr[$nRenglon]; 
                $renglones = $renglones->push(clone $registro);
            }
            $nRenglon = $nRenglon + 1 ;
        }        

     

        ///Numerar las piezas
        $reccount = $renglones->count();
         

        $talonario = new Talonario;
        $proximo_numero = $talonario->proximodocumento('PIEZA');       

        foreach ($renglones as $renglon) {
            
            $renglon->inventario = $proximo_numero++ ;
 
        }  

        //dd($renglones);

 
       

        $data['renglones'] = $renglones;     
        $data['cheque_id'] = $id;     

 


        

        return view('cheques.rendicion',$data);
    }




    /**
     * Guardar recibo
     *
     * @param CreateReciboRequest $request
     *
     * @return Response
     */
    public function rendicion_guardar(Request $request)
    {



        try {


      $cheque_id = $request->cheque_id;

      /** @var Cheque $cheque */
      $cheque = Cheque::find($cheque_id);

      if (empty($cheque)) {
          dd('Cheque no encontrado');
 
      }

      /*listar las piezas a rendir*/

      $recibosr = DB::table('recibos_lineas as rr')
      ->join('recibos as r', 'rr.recibo_id', '=', 'r.id')
      ->join('tipopiezas as p', 'rr.tipopieza_id', '=', 'p.id')
      ->join('artesanos as a', 'r.artesano_id', '=', 'a.id')
      ->select('r.id','r.cheque_id','r.formulario', 'r.artesano_id',  'rr.tipopieza_id', 'rr.cantidad', 'rr.preciounit', 
      'rr.importe', 'p.descrip','p.tecnica','p.precio','a.nombre', 'rr.tipopieza_id as inventario','r.fecha' )
      ->whereRaw('cheque_id = ?', $cheque_id) 
      ->get();

      //dd($recibosr);
      //$reccount = $recibosr->count();

      $renglones = collect($recibosr) ;

      //dd($renglones);
      
      // Multiplicar los renglones que tienen cantidad > 1
      $nRenglon = 0;
      foreach ($recibosr as $recibos) {
     
          for ($i = 1; $i <= $recibos->cantidad ; $i++) {
              
              $registro = $recibosr[$nRenglon]; 
              $renglones = $renglones->push(clone $registro);
          }
          $nRenglon = $nRenglon + 1 ;
      }        

      //dd($renglones);
      ///Numerar las piezas
      $reccount = $renglones->count();
       

      $talonario = new Talonario;
    //   $proximo_numero = $talonario->proximodocumento('PIEZA');       

      foreach ($renglones as $renglon) {
          
        //   $renglon->inventario = $proximo_numero++ ;


               //Pedir número de pieza
               $nueva_pieza = $talonario->proximodocumento('pieza');                       

                     
                     

                //dd($renglon);


                // // {#1663 ▼
                // //     +"id": 10
                // //     +"cheque_id": 9
                // //     +"formulario": "00000010"
                // //     +"artesano_id": 72
                // //     +"tipopieza_id": 72
                // //     +"cantidad": 5
                // //     +"preciounit": "390.00"
                // //     +"importe": "1950.00"
                // //     +"descrip": "LAZO"
                // //     +"tecnica": "TRENZA DE 8 T."
                // //     +"precio": "390.00"
                // //     +"nombre": "DIAZ, NIEVES OSVALDO"
                // //     +"inventario": 72
                // //     +"fecha": "2022-10-26"
                // //   }

                    
               $inventario = new Inventario();
               // dd('hasta aqui 3',$inventario);
               $inventario->npieza       = $nueva_pieza;
               
               //$inventario->numero    = $request->descrip[$cont];
               $inventario->codigo12     = $nueva_pieza;
               $inventario->tipopieza_id = $renglon->tipopieza_id;
               $inventario->comprob      = $renglon->formulario;
               $inventario->namepieza    = $renglon->descrip .' '.$renglon->tecnica;
               $inventario->recibo_id      = $renglon->id ;
               $inventario->costo      = $renglon->preciounit;
               $inventario->recargo    = '0';
               $inventario->artesano_id    = $renglon->artesano_id;
               $inventario->comprado_at    = $renglon->fecha;
               $inventario->precio     = $renglon->preciounit * 1.3 ;
               $inventario->precio_at  = $renglon->fecha;
               $inventario->foto       = ' ';

               $inventario->save();

               //Dejar grabado próximo número de pieza
               $talonario->Actualizarproximodocumento('pieza',$nueva_pieza);


               $rendicion  = new Rendicion();
               $rendicion->cheque_id     = $cheque_id ;
               $rendicion->inventario_id = $inventario->id ;
               $rendicion->recibo_id     = $renglon->id ;
               $rendicion->importe       = $renglon->preciounit;
               $rendicion->save() ;



      }          


               
                //dd($input);
                $cheque_id = $request->cheque_id;
                //dd($request->cheque_id);

                    //GUARDAR RENGLONES DEL RECIBO
               

                $mytime= Carbon::now('America/Argentina/Mendoza');
                //dd($cheque_id);
                $cheque = Cheque::find($cheque_id);
                $cheque->rendido_at = $mytime;
                $cheque->save();


            // Aqui construyo el link de impresion que va en el botón de la barra de herramientas
            $link_impresion = url('/cheques/imprimir_rendicion/'.$cheque_id);


            ////////////////////////////////////////////
            //return redirect()->route('facturas.factura.index')
            // Devuelvo elementos para la barra de herramientas, y el link para imprimir la factura recién hecha

            return back()->withInput()
            ->with('success_message', 'Rendición grabada: '.$cheque_id )            
            ->with('link_impresion',$link_impresion );    



 


        } catch(Exception $e){
            
            
              


                $mensaje_error= $e->getMessage(); 
                Flash::error($mensaje_error );                    
                return back()->withInput()
                    ->withErrors([$mensaje_error]);
        }                  
    }


    /**
     * Imprime en PDF LA rendicion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function imprimir($id)
    {
        $cheque = Cheque::findOrFail($id);

 
   

        $renglones= DB::table('rendiciones as r')
        ->join('cheques as ch', 'r.cheque_id', '=', 'ch.id')
        ->join('inventarios as i', 'r.inventario_id', '=', 'i.id')
        ->join('recibos as rr', 'r.recibo_id', '=', 'rr.id')
        ->select('r.id','r.cheque_id','rr.formulario', 'r.inventario_id' ,'i.npieza','i.namepieza',
        'rr.formulario','r.importe' )
        ->whereRaw('r.cheque_id = ?', $id) 
        ->get();
 
        //->get()->toArray();

        //dd($renglones);

        $this->pdf($cheque,$renglones);
        

        return view('cheques.show', compact('cheque'));
    }


    public function pdf($cheque,$renglones,$accion='ver',$tipo='digital')
    {

        //dd($cheque);

        //$sistema = Sistema::findOrFail(1);

        //$cuit_cliente = $factura->cuit;        
        //$ruc = "10072486893";
 
        $dia = "09";
        $mes = "04";
        $ayo = "17";

   

        $dni = "23918745";
        $total = 0;

        //print_r($detalle);
        //die();



        //$total = number_format($total,2,'.',' ');
 
         
        $data['numero'] = $cheque->numero;
        
        $data['dia'] = $dia;
        $data['mes'] = $mes;
        $data['ayo'] = $ayo;
        
        

        
        $data['total'] = '$10000';
        $data['renglones'] = $renglones;
        $data['cheque'] = $cheque;
        //dd( $renglones ) ;
        
 
        //AQUI VA LA VISTA PDF DE LA FACTURA

        if($accion=='html'){
            return view('pdf.rendicion',$data);
        }else{
            $html = view('pdf.rendicion',$data)->render();
        }


        $namefile = 'boleta_de_venta_'.time().'.pdf';
 
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        // CORRECCIONES DE FUENTES 20220627 POR PROBLEMAS CON FONT ARIAL
        $mpdf = new Mpdf([
            // 'fontDir' => array_merge($fontDirs, [
            //     public_path() . '/fonts',
            // ]),
            // 'fontdata' => $fontData + [
            //     'arial' => [
            //         'R' => 'FreeSans.ttf',
            //         'B' => 'FreeSansBold.ttf',
            //     ],
            // ],
            'default_font' => 'arial',
            "format" => "A4",
            //"format" => [264.8,188.9],
        ]);

        
        // $mpdf->SetTopMargin(5);
     
        //PIE DE PAGINA    
        // $mpdf->SetHTMLFooter('
        // <table width="100%">
        //     <tr>

        //      <td width="73%" align="left"><img id="logo" src="images/logoafip.jpg" alt="" width="150" height="57"></td> 


        //     </tr>
        //     <tr>
        //         <td width="33%">{DATE j/m/Y}</td>
        //         <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        //         <td width="33%" style="text-align: right;">Factura Electrónica</td>
        //     </tr>            
        // </table>');

        //dd('aa');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        //dd($namefile);
        $mpdf->Output($namefile,"I");

        if($accion=='ver'){
            $mpdf->Output($namefile,"I");
        }elseif($accion=='descargar'){
            $mpdf->Output($namefile,"D");
        }
    }    







}
