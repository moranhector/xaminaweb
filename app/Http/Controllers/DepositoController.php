<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepositoRequest;
use App\Http\Requests\UpdateDepositoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Deposito;
use Illuminate\Http\Request;
use Flash;
use Response;

class DepositoController extends AppBaseController
{
    /**
     * Display a listing of the Deposito.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Deposito $depositos */
        $depositos = Deposito::all();

        return view('depositos.index')
            ->with('depositos', $depositos);
    }

    /**
     * Show the form for creating a new Deposito.
     *
     * @return Response
     */
    public function create()
    {
        return view('depositos.create');
    }

    /**
     * Store a newly created Deposito in storage.
     *
     * @param CreateDepositoRequest $request
     *
     * @return Response
     */
    public function store(CreateDepositoRequest $request)
    {
        $input = $request->all();

        /** @var Deposito $deposito */
        $deposito = Deposito::create($input);

        Flash::success('Depósito guardado correctamente.');

        return redirect(route('depositos.index'));
    }

    /**
     * Display the specified Deposito.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Deposito $deposito */
        $deposito = Deposito::find($id);

        if (empty($deposito)) {
            Flash::error('Depósito no encontrado');

            return redirect(route('depositos.index'));
        }

        return view('depositos.show')->with('deposito', $deposito);
    }

    /**
     * Show the form for editing the specified Deposito.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Deposito $deposito */
        $deposito = Deposito::find($id);

        if (empty($deposito)) {
            Flash::error('Depósito no encontrado');

            return redirect(route('depositos.index'));
        }

        return view('depositos.edit')->with('deposito', $deposito);
    }

    /**
     * Update the specified Deposito in storage.
     *
     * @param int $id
     * @param UpdateDepositoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepositoRequest $request)
    {
        /** @var Deposito $deposito */
        $deposito = Deposito::find($id);

        if (empty($deposito)) {
            Flash::error('Depósito no encontrado');

            return redirect(route('depositos.index'));
        }

        $deposito->fill($request->all());
        $deposito->save();

        Flash::success('Depósito guardado correctamente.');

        return redirect(route('depositos.index'));
    }

    /**
     * Remove the specified Deposito from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Deposito $deposito */
        $deposito = Deposito::find($id);

        if (empty($deposito)) {
            Flash::error('Depósito no encontrado');

            return redirect(route('depositos.index'));
        }

        $deposito->delete();

        Flash::success('Depósito ha sido eliminado.');

        return redirect(route('depositos.index'));
    }
}
