<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTalonarioRequest;
use App\Http\Requests\UpdateTalonarioRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Talonario;
use Illuminate\Http\Request;
use Flash;
use Response;

class TalonarioController extends AppBaseController
{
    /**
     * Display a listing of the Talonario.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Talonario $talonarios */
        $talonarios = Talonario::all();

        return view('talonarios.index')
            ->with('talonarios', $talonarios);
    }

    /**
     * Show the form for creating a new Talonario.
     *
     * @return Response
     */
    public function create()
    {
        return view('talonarios.create');
    }




    /**
     * Store a newly created Talonario in storage.
     *
     * @param CreateTalonarioRequest $request
     *
     * @return Response
     */
    public function store(CreateTalonarioRequest $request)
    {
        $input = $request->all();

        /** @var Talonario $talonario */
        $talonario = Talonario::create($input);

        Flash::success('Talonario saved successfully.');

        return redirect(route('talonarios.index'));
    }

    /**
     * Display the specified Talonario.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Talonario $talonario */
        $talonario = Talonario::find($id);

        if (empty($talonario)) {
            Flash::error('Talonario not found');

            return redirect(route('talonarios.index'));
        }

        return view('talonarios.show')->with('talonario', $talonario);
    }

    /**
     * Show the form for editing the specified Talonario.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Talonario $talonario */
        $talonario = Talonario::find($id);

        if (empty($talonario)) {
            Flash::error('Talonario not found');

            return redirect(route('talonarios.index'));
        }

        return view('talonarios.edit')->with('talonario', $talonario);
    }

    /**
     * Update the specified Talonario in storage.
     *
     * @param int $id
     * @param UpdateTalonarioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTalonarioRequest $request)
    {
        /** @var Talonario $talonario */
        $talonario = Talonario::find($id);

        if (empty($talonario)) {
            Flash::error('Talonario not found');

            return redirect(route('talonarios.index'));
        }

        $talonario->fill($request->all());
        $talonario->save();

        Flash::success('Talonario updated successfully.');

        return redirect(route('talonarios.index'));
    }







    /**
     * Remove the specified Talonario from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Talonario $talonario */
        $talonario = Talonario::find($id);

        if (empty($talonario)) {
            Flash::error('Talonario not found');

            return redirect(route('talonarios.index'));
        }

        $talonario->delete();

        Flash::success('Talonario deleted successfully.');

        return redirect(route('talonarios.index'));
    }




}
