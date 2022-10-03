<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRemitoRequest;
use App\Http\Requests\UpdateRemitoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Remito;
use Illuminate\Http\Request;
use Flash;
use Response;

class RemitoController extends AppBaseController
{
    /**
     * Display a listing of the Remito.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Remito $remitos */
        $remitos = Remito::all();

        return view('remitos.index')
            ->with('remitos', $remitos);
    }

    /**
     * Show the form for creating a new Remito.
     *
     * @return Response
     */
    public function create()
    {
        return view('remitos.create');
    }

    /**
     * Store a newly created Remito in storage.
     *
     * @param CreateRemitoRequest $request
     *
     * @return Response
     */
    public function store(CreateRemitoRequest $request)
    {
        $input = $request->all();

        /** @var Remito $remito */
        $remito = Remito::create($input);

        Flash::success('Remito saved successfully.');

        return redirect(route('remitos.index'));
    }

    /**
     * Display the specified Remito.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Remito $remito */
        $remito = Remito::find($id);

        if (empty($remito)) {
            Flash::error('Remito not found');

            return redirect(route('remitos.index'));
        }

        return view('remitos.show')->with('remito', $remito);
    }

    /**
     * Show the form for editing the specified Remito.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Remito $remito */
        $remito = Remito::find($id);

        if (empty($remito)) {
            Flash::error('Remito not found');

            return redirect(route('remitos.index'));
        }

        return view('remitos.edit')->with('remito', $remito);
    }

    /**
     * Update the specified Remito in storage.
     *
     * @param int $id
     * @param UpdateRemitoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRemitoRequest $request)
    {
        /** @var Remito $remito */
        $remito = Remito::find($id);

        if (empty($remito)) {
            Flash::error('Remito not found');

            return redirect(route('remitos.index'));
        }

        $remito->fill($request->all());
        $remito->save();

        Flash::success('Remito updated successfully.');

        return redirect(route('remitos.index'));
    }

    /**
     * Remove the specified Remito from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Remito $remito */
        $remito = Remito::find($id);

        if (empty($remito)) {
            Flash::error('Remito not found');

            return redirect(route('remitos.index'));
        }

        $remito->delete();

        Flash::success('Remito deleted successfully.');

        return redirect(route('remitos.index'));
    }
}
