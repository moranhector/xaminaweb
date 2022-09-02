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

class ChequeController extends AppBaseController
{
    /**
     * Display a listing of the Cheque.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Cheque $cheques */
        $cheques = Cheque::all();

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
        return view('cheques.create');
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

        /** @var Cheque $cheque */
        $cheque = Cheque::create($input);

        Flash::success('Cheque saved successfully.');

        return redirect(route('cheques.index'));
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

        if (empty($cheque)) {
            Flash::error('Cheque not found');

            return redirect(route('cheques.index'));
        }

        $cheque->delete();

        Flash::success('Cheque deleted successfully.');

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
        'rr.importe', 'p.descrip','p.tecnica','p.precio','a.nombre' )
        ->whereRaw('cheque_id = ?', $id) 
        ->get();

        //collect(['zero', 'two', 'three'])->insertAt(1, 'one');
        //$recibosr->insertAt(3, 'one');

        //dd($recibosr);

        $reccount = $recibosr->count();

        // foreach ($recibosr as &$recibos) {

        //         if ( $recibos->cantidad > 1 ){
        //             dd($recibos);
        //         }
            
        // }

        $renglones = collect() ;

        //dd($renglones);

        $nRenglon = 0;
        foreach ($recibosr as &$recibos) {

            
            for ($i = 1; $i <= $recibos->cantidad ; $i++) {
                
                $registro = $recibosr->at( $nRenglon ); // 1

                $renglones = $renglones->push($registro);

                
            }
        
            $nRenglon = $nRenglon + 1 ;
        }        

        dd($renglones);



       


        // APPEND FROM REGISTRO 
        // $recibosr->push($registro2); Spatie Laravel Collection
 
       


 




        return view('cheques.show')->with('cheque', $cheque);
    }





}
