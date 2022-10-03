<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRemito_lineaRequest;
use App\Http\Requests\UpdateRemito_lineaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Remito_linea;
use Illuminate\Http\Request;
use Flash;
use Response;

class Remito_lineaController extends AppBaseController
{
    /**
     * Display a listing of the Remito_linea.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Remito_linea $remitoLineas */
        $remitoLineas = Remito_linea::all();

        return view('remito_lineas.index')
            ->with('remitoLineas', $remitoLineas);
    }

    /**
     * Show the form for creating a new Remito_linea.
     *
     * @return Response
     */
    public function create()
    {
        return view('remito_lineas.create');
    }

    /**
     * Store a newly created Remito_linea in storage.
     *
     * @param CreateRemito_lineaRequest $request
     *
     * @return Response
     */
    public function store(CreateRemito_lineaRequest $request)
    {
        $input = $request->all();

        /** @var Remito_linea $remitoLinea */
        $remitoLinea = Remito_linea::create($input);

        Flash::success('Remito Linea saved successfully.');

        return redirect(route('remitoLineas.index'));
    }

    /**
     * Display the specified Remito_linea.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Remito_linea $remitoLinea */
        $remitoLinea = Remito_linea::find($id);

        if (empty($remitoLinea)) {
            Flash::error('Remito Linea not found');

            return redirect(route('remitoLineas.index'));
        }

        return view('remito_lineas.show')->with('remitoLinea', $remitoLinea);
    }

    /**
     * Show the form for editing the specified Remito_linea.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Remito_linea $remitoLinea */
        $remitoLinea = Remito_linea::find($id);

        if (empty($remitoLinea)) {
            Flash::error('Remito Linea not found');

            return redirect(route('remitoLineas.index'));
        }

        return view('remito_lineas.edit')->with('remitoLinea', $remitoLinea);
    }

    /**
     * Update the specified Remito_linea in storage.
     *
     * @param int $id
     * @param UpdateRemito_lineaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRemito_lineaRequest $request)
    {
        /** @var Remito_linea $remitoLinea */
        $remitoLinea = Remito_linea::find($id);

        if (empty($remitoLinea)) {
            Flash::error('Remito Linea not found');

            return redirect(route('remitoLineas.index'));
        }

        $remitoLinea->fill($request->all());
        $remitoLinea->save();

        Flash::success('Remito Linea updated successfully.');

        return redirect(route('remitoLineas.index'));
    }

    /**
     * Remove the specified Remito_linea from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Remito_linea $remitoLinea */
        $remitoLinea = Remito_linea::find($id);

        if (empty($remitoLinea)) {
            Flash::error('Remito Linea not found');

            return redirect(route('remitoLineas.index'));
        }

        $remitoLinea->delete();

        Flash::success('Remito Linea deleted successfully.');

        return redirect(route('remitoLineas.index'));
    }
}
