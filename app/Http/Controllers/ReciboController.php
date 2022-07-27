<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReciboRequest;
use App\Http\Requests\UpdateReciboRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Recibo;
use Illuminate\Http\Request;
use Flash;
use Response;

class ReciboController extends AppBaseController
{
    /**
     * Display a listing of the Recibo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Recibo $recibos */
        $recibos = Recibo::all();

        return view('recibos.index')
            ->with('recibos', $recibos);
    }

    /**
     * Show the form for creating a new Recibo.
     *
     * @return Response
     */
    public function create()
    {
        return view('recibos.create');
    }

    /**
     * Store a newly created Recibo in storage.
     *
     * @param CreateReciboRequest $request
     *
     * @return Response
     */
    public function store(CreateReciboRequest $request)
    {
        $input = $request->all();

        /** @var Recibo $recibo */
        $recibo = Recibo::create($input);

        Flash::success('Recibo saved successfully.');

        return redirect(route('recibos.index'));
    }

    /**
     * Display the specified Recibo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo not found');

            return redirect(route('recibos.index'));
        }

        return view('recibos.show')->with('recibo', $recibo);
    }

    /**
     * Show the form for editing the specified Recibo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo not found');

            return redirect(route('recibos.index'));
        }

        return view('recibos.edit')->with('recibo', $recibo);
    }

    /**
     * Update the specified Recibo in storage.
     *
     * @param int $id
     * @param UpdateReciboRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboRequest $request)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo not found');

            return redirect(route('recibos.index'));
        }

        $recibo->fill($request->all());
        $recibo->save();

        Flash::success('Recibo updated successfully.');

        return redirect(route('recibos.index'));
    }

    /**
     * Remove the specified Recibo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo not found');

            return redirect(route('recibos.index'));
        }

        $recibo->delete();

        Flash::success('Recibo deleted successfully.');

        return redirect(route('recibos.index'));
    }
}
