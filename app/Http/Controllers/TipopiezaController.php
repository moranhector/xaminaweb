<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipopiezaRequest;
use App\Http\Requests\UpdateTipopiezaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Tipopieza;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\DB;

class TipopiezaController extends AppBaseController
{
    /**
     * Display a listing of the Tipopieza.
     *
     * @param Request $request
     *
     * @return Response
     */
    // public function index(Request $request)
    // {
    //     /** @var Tipopieza $tipopiezas */
    //     $tipopiezas = Tipopieza::all();

    //     return view('tipopiezas.index')
    //         ->with('tipopiezas', $tipopiezas);
    // }

    public function index(Request $request)
    {

        $descrip  = $request->get('descrip');

        if($descrip)
        {        
            $tipopiezas = DB::table('tipopiezas')
            ->where('descrip','like','%'.$descrip.'%' ) 
            ->paginate( 100 ) ;   

            $data['tipopiezas'] = $tipopiezas;     
            $data['descrip'] = $descrip;     

            Flash::success('Filtrando '.$descrip);              

            return view('tipopiezas.index',["tipopiezas"=>$tipopiezas,"descrip"=>$descrip]);            
        } 
        else
        {
            //$tipopiezas = Inventario::all()->paginate(25);
            $tipopiezas = DB::table('tipopiezas')->paginate(25);
        }
        return view('tipopiezas.index')
            ->with('tipopiezas', $tipopiezas);
    }



    /**
     * Show the form for creating a new Tipopieza.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipopiezas.create');
    }

    /**
     * Store a newly created Tipopieza in storage.
     *
     * @param CreateTipopiezaRequest $request
     *
     * @return Response
     */
    public function store(CreateTipopiezaRequest $request)
    {
        $input = $request->all();

        /** @var Tipopieza $tipopieza */
        $tipopieza = Tipopieza::create($input);

        Flash::success('Tipo de pieza guardado correctamente.');

        return redirect(route('tipopiezas.index'));
    }

    /**
     * Display the specified Tipopieza.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tipopieza $tipopieza */
        $tipopieza = Tipopieza::find($id);

        if (empty($tipopieza)) {
            Flash::error('Tipo de pieza no encontrado');

            return redirect(route('tipopiezas.index'));
        }

        return view('tipopiezas.show')->with('tipopieza', $tipopieza);
    }

    /**
     * Show the form for editing the specified Tipopieza.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Tipopieza $tipopieza */
        $tipopieza = Tipopieza::find($id);

        if (empty($tipopieza)) {
            Flash::error('Tipo de pieza no encontrado');

            return redirect(route('tipopiezas.index'));
        }

        return view('tipopiezas.edit')->with('tipopieza', $tipopieza);
    }

    /**
     * Update the specified Tipopieza in storage.
     *
     * @param int $id
     * @param UpdateTipopiezaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipopiezaRequest $request)
    {
        /** @var Tipopieza $tipopieza */
        $tipopieza = Tipopieza::find($id);

        if (empty($tipopieza)) {
            Flash::error('Tipo de pieza no encontrado');

            return redirect(route('tipopiezas.index'));
        }

        $tipopieza->fill($request->all());
        $tipopieza->save();

        Flash::success('Tipo de pieza guardado correctamente.');

        return redirect(route('tipopiezas.index'));
    }

    /**
     * Remove the specified Tipopieza from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tipopieza $tipopieza */
        $tipopieza = Tipopieza::find($id);

        if (empty($tipopieza)) {
            Flash::error('Tipo de pieza no encontrado');

            return redirect(route('tipopiezas.index'));
        }

        $tipopieza->delete();

        Flash::success('Tipo de pieza ha sido eliminado.');

        return redirect(route('tipopiezas.index'));
    }
}
