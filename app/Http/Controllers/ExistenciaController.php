<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExistenciaRequest;
use App\Http\Requests\UpdateExistenciaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Existencia;
use Illuminate\Http\Request;
use Flash;
use Response;

class ExistenciaController extends AppBaseController
{
    /**
     * Display a listing of the Existencia.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Existencia $existencias */
        $existencias = Existencia::all();

        return view('existencias.index')
            ->with('existencias', $existencias);
    }

    /**
     * Show the form for creating a new Existencia.
     *
     * @return Response
     */
    public function create()
    {
        return view('existencias.create');
    }

    /**
     * Store a newly created Existencia in storage.
     *
     * @param CreateExistenciaRequest $request
     *
     * @return Response
     */
    public function store(CreateExistenciaRequest $request)
    {
        $input = $request->all();

        /** @var Existencia $existencia */
        $existencia = Existencia::create($input);

        Flash::success('Existencia saved successfully.');

        return redirect(route('existencias.index'));
    }

    /**
     * Display the specified Existencia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Existencia $existencia */
        $existencia = Existencia::find($id);

        if (empty($existencia)) {
            Flash::error('Existencia not found');

            return redirect(route('existencias.index'));
        }

        return view('existencias.show')->with('existencia', $existencia);
    }

    /**
     * Show the form for editing the specified Existencia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Existencia $existencia */
        $existencia = Existencia::find($id);

        if (empty($existencia)) {
            Flash::error('Existencia not found');

            return redirect(route('existencias.index'));
        }

        return view('existencias.edit')->with('existencia', $existencia);
    }

    /**
     * Update the specified Existencia in storage.
     *
     * @param int $id
     * @param UpdateExistenciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExistenciaRequest $request)
    {
        /** @var Existencia $existencia */
        $existencia = Existencia::find($id);

        if (empty($existencia)) {
            Flash::error('Existencia not found');

            return redirect(route('existencias.index'));
        }

        $existencia->fill($request->all());
        $existencia->save();

        Flash::success('Existencia updated successfully.');

        return redirect(route('existencias.index'));
    }

    /**
     * Remove the specified Existencia from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Existencia $existencia */
        $existencia = Existencia::find($id);

        if (empty($existencia)) {
            Flash::error('Existencia not found');

            return redirect(route('existencias.index'));
        }

        $existencia->delete();

        Flash::success('Existencia deleted successfully.');

        return redirect(route('existencias.index'));
    }
}
