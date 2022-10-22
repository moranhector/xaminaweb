<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Flash;
use Response;

class EstudianteController extends AppBaseController
{
    /**
     * Display a listing of the Estudiante.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Estudiante $estudiantes */
        $estudiantes = Estudiante::all();

        return view('estudiantes.index')
            ->with('estudiantes', $estudiantes);
    }

    /**
     * Show the form for creating a new Estudiante.
     *
     * @return Response
     */
    public function create()
    {
        return view('estudiantes.create');
    }

    /**
     * Store a newly created Estudiante in storage.
     *
     * @param CreateEstudianteRequest $request
     *
     * @return Response
     */
    public function store(CreateEstudianteRequest $request)
    {
        $input = $request->all();

        /** @var Estudiante $estudiante */
        $estudiante = Estudiante::create($input);

        Flash::success('Estudiante saved successfully.');

        return redirect(route('estudiantes.index'));
    }

    /**
     * Display the specified Estudiante.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Estudiante $estudiante */
        $estudiante = Estudiante::find($id);

        if (empty($estudiante)) {
            Flash::error('Estudiante not found');

            return redirect(route('estudiantes.index'));
        }

        return view('estudiantes.show')->with('estudiante', $estudiante);
    }

    /**
     * Show the form for editing the specified Estudiante.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Estudiante $estudiante */
        $estudiante = Estudiante::find($id);

        if (empty($estudiante)) {
            Flash::error('Estudiante not found');

            return redirect(route('estudiantes.index'));
        }

        return view('estudiantes.edit')->with('estudiante', $estudiante);
    }

    /**
     * Update the specified Estudiante in storage.
     *
     * @param int $id
     * @param UpdateEstudianteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstudianteRequest $request)
    {
        /** @var Estudiante $estudiante */
        $estudiante = Estudiante::find($id);

        if (empty($estudiante)) {
            Flash::error('Estudiante not found');

            return redirect(route('estudiantes.index'));
        }

        $estudiante->fill($request->all());
        $estudiante->save();

        Flash::success('Estudiante updated successfully.');

        return redirect(route('estudiantes.index'));
    }

    /**
     * Remove the specified Estudiante from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Estudiante $estudiante */
        $estudiante = Estudiante::find($id);

        if (empty($estudiante)) {
            Flash::error('Estudiante not found');

            return redirect(route('estudiantes.index'));
        }

        $estudiante->delete();

        Flash::success('Estudiante deleted successfully.');

        return redirect(route('estudiantes.index'));
    }
}
