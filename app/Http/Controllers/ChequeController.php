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

            $cheque->save();


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
            Flash::error('Cheque not found');

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
            Flash::error('Cheque not found');

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
            Flash::error('Cheque not found');

            return redirect(route('cheques.index'));
        }

        $cheque->fill($request->all());
        $cheque->save();

        Flash::success('Cheque updated successfully.');

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
    public function destroy($id)
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
            Flash::error('Cheque not found');

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

                $input = $request->all();
                //dd($input);
                $cheque_id = $request->cheque_id;
                //dd($request->cheque_id);

                    //GUARDAR RENGLONES DEL RECIBO
                    $lineas_detalle = $request->inventario ; //Tomo el Id del Recibo insertado                
                    $cont=0;

                //Fecha
                $mytime= Carbon::now('America/Argentina/Mendoza');
                $mytime= $mytime->toDateString();

  
                while($cont < count($lineas_detalle)){





                    
                    $inventario = new Inventario();
                    // dd('hasta aqui 3',$inventario);
                    $inventario->npieza       = $request->inventario[$cont];
                    
                    $inventario->numero    = $request->descrip[$cont];
                    $inventario->codigo12     = $request->inventario[$cont];
                    $inventario->tipopieza_id = 1;
                    $inventario->comprob      = '1';
                    $inventario->recibo_id      = '1';
                    $inventario->costo      = '1';
                    $inventario->recargo    = '1';
                    $inventario->artesano_id    = '1';
                    $inventario->comprado_at    = $mytime;
                    $inventario->vendido_at     = $mytime;
                    $inventario->precio     = 0;
 
                    $inventario->save();

                    $rendicion  = new Rendicion();
                    $rendicion->cheque_id     = $cheque_id ;
                    $rendicion->inventario_id = $inventario->id ;
                    $rendicion->recibo_id     = 1 ;
                    $rendicion->importe       = 1 ;
                    $rendicion->save() ;


                    $cont=$cont+1;
                }

                $mytime= Carbon::now('America/Argentina/Mendoza');
                //dd($cheque_id);
                $cheque = Cheque::find($cheque_id);
                $cheque->rendido_at = $mytime;
                $cheque->save();





                return redirect(route('cheques.index'));


        } catch(Exception $e){
            
            
              


                $mensaje_error= $e->getMessage(); 
                Flash::error($mensaje_error );                    
                return back()->withInput()
                    ->withErrors([$mensaje_error]);
        }                  
    }










}
