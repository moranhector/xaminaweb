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
            ->paginate( 100 ) ;   

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
}
