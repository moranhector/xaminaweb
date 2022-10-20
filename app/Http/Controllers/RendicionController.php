<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRendicionRequest;
use App\Http\Requests\UpdateRendicionRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Rendicion;
use Illuminate\Http\Request;
use Flash;
use Response;

class RendicionController extends AppBaseController
{
    /**
     * Display a listing of the Rendicion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Rendicion $rendiciones */
        $rendiciones = Rendicion::all();

        return view('rendiciones.index')
            ->with('rendiciones', $rendiciones);
    }

    /**
     * Show the form for creating a new Rendicion.
     *
     * @return Response
     */
    public function create()
    {
        return view('rendiciones.create');
    }

    /**
     * Store a newly created Rendicion in storage.
     *
     * @param CreateRendicionRequest $request
     *
     * @return Response
     */
    public function store(CreateRendicionRequest $request)
    {
        $input = $request->all();

        /** @var Rendicion $rendicion */
        $rendicion = Rendicion::create($input);

        Flash::success('Existencia guardado correctamente.');

        return redirect(route('rendiciones.index'));
    }

    /**
     * Display the specified Rendicion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Rendicion $rendicion */
        $rendicion = Rendicion::find($id);

        if (empty($rendicion)) {
            Flash::error('Rendicion not found');

            return redirect(route('rendiciones.index'));
        }

        return view('rendiciones.show')->with('rendicion', $rendicion);
    }

    /**
     * Show the form for editing the specified Rendicion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Rendicion $rendicion */
        $rendicion = Rendicion::find($id);

        if (empty($rendicion)) {
            Flash::error('Rendicion not found');

            return redirect(route('rendiciones.index'));
        }

        return view('rendiciones.edit')->with('rendicion', $rendicion);
    }

    /**
     * Update the specified Rendicion in storage.
     *
     * @param int $id
     * @param UpdateRendicionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRendicionRequest $request)
    {
        /** @var Rendicion $rendicion */
        $rendicion = Rendicion::find($id);

        if (empty($rendicion)) {
            Flash::error('Rendicion not found');

            return redirect(route('rendiciones.index'));
        }

        $rendicion->fill($request->all());
        $rendicion->save();

        Flash::success('Existencia guardado correctamente.');

        return redirect(route('rendiciones.index'));
    }

    /**
     * Remove the specified Rendicion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Rendicion $rendicion */
        $rendicion = Rendicion::find($id);

        if (empty($rendicion)) {
            Flash::error('Rendicion not found');

            return redirect(route('rendiciones.index'));
        }

        $rendicion->delete();

        Flash::success('Rendicion deleted successfully.');

        return redirect(route('rendiciones.index'));
    }
}
