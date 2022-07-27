<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecibosLineasRequest;
use App\Http\Requests\UpdateRecibosLineasRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RecibosLineas;
use Illuminate\Http\Request;
use Flash;
use Response;

class RecibosLineasController extends AppBaseController
{
    /**
     * Display a listing of the RecibosLineas.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var RecibosLineas $recibosLineas */
        $recibosLineas = RecibosLineas::all();

        return view('recibos_lineas.index')
            ->with('recibosLineas', $recibosLineas);
    }

    /**
     * Show the form for creating a new RecibosLineas.
     *
     * @return Response
     */
    public function create()
    {
        return view('recibos_lineas.create');
    }

    /**
     * Store a newly created RecibosLineas in storage.
     *
     * @param CreateRecibosLineasRequest $request
     *
     * @return Response
     */
    public function store(CreateRecibosLineasRequest $request)
    {
        $input = $request->all();

        /** @var RecibosLineas $recibosLineas */
        $recibosLineas = RecibosLineas::create($input);

        Flash::success('Recibos Lineas saved successfully.');

        return redirect(route('recibosLineas.index'));
    }

    /**
     * Display the specified RecibosLineas.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RecibosLineas $recibosLineas */
        $recibosLineas = RecibosLineas::find($id);

        if (empty($recibosLineas)) {
            Flash::error('Recibos Lineas not found');

            return redirect(route('recibosLineas.index'));
        }

        return view('recibos_lineas.show')->with('recibosLineas', $recibosLineas);
    }

    /**
     * Show the form for editing the specified RecibosLineas.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var RecibosLineas $recibosLineas */
        $recibosLineas = RecibosLineas::find($id);

        if (empty($recibosLineas)) {
            Flash::error('Recibos Lineas not found');

            return redirect(route('recibosLineas.index'));
        }

        return view('recibos_lineas.edit')->with('recibosLineas', $recibosLineas);
    }

    /**
     * Update the specified RecibosLineas in storage.
     *
     * @param int $id
     * @param UpdateRecibosLineasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRecibosLineasRequest $request)
    {
        /** @var RecibosLineas $recibosLineas */
        $recibosLineas = RecibosLineas::find($id);

        if (empty($recibosLineas)) {
            Flash::error('Recibos Lineas not found');

            return redirect(route('recibosLineas.index'));
        }

        $recibosLineas->fill($request->all());
        $recibosLineas->save();

        Flash::success('Recibos Lineas updated successfully.');

        return redirect(route('recibosLineas.index'));
    }

    /**
     * Remove the specified RecibosLineas from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RecibosLineas $recibosLineas */
        $recibosLineas = RecibosLineas::find($id);

        if (empty($recibosLineas)) {
            Flash::error('Recibos Lineas not found');

            return redirect(route('recibosLineas.index'));
        }

        $recibosLineas->delete();

        Flash::success('Recibos Lineas deleted successfully.');

        return redirect(route('recibosLineas.index'));
    }
}
