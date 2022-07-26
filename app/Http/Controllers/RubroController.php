<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRubroRequest;
use App\Http\Requests\UpdateRubroRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Rubro;
use Illuminate\Http\Request;
use Flash;
use Response;

class RubroController extends AppBaseController
{
    /**
     * Display a listing of the Rubro.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Rubro $rubros */
        $rubros = Rubro::all();

        return view('rubros.index')
            ->with('rubros', $rubros);
    }

    /**
     * Show the form for creating a new Rubro.
     *
     * @return Response
     */
    public function create()
    {
        return view('rubros.create');
    }

    /**
     * Store a newly created Rubro in storage.
     *
     * @param CreateRubroRequest $request
     *
     * @return Response
     */
    public function store(CreateRubroRequest $request)
    {
        $input = $request->all();

        /** @var Rubro $rubro */
        $rubro = Rubro::create($input);

        Flash::success('Rubro saved successfully.');

        return redirect(route('rubros.index'));
    }

    /**
     * Display the specified Rubro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Rubro $rubro */
        $rubro = Rubro::find($id);

        if (empty($rubro)) {
            Flash::error('Rubro not found');

            return redirect(route('rubros.index'));
        }

        return view('rubros.show')->with('rubro', $rubro);
    }

    /**
     * Show the form for editing the specified Rubro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Rubro $rubro */
        $rubro = Rubro::find($id);

        if (empty($rubro)) {
            Flash::error('Rubro not found');

            return redirect(route('rubros.index'));
        }

        return view('rubros.edit')->with('rubro', $rubro);
    }

    /**
     * Update the specified Rubro in storage.
     *
     * @param int $id
     * @param UpdateRubroRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRubroRequest $request)
    {
        /** @var Rubro $rubro */
        $rubro = Rubro::find($id);

        if (empty($rubro)) {
            Flash::error('Rubro not found');

            return redirect(route('rubros.index'));
        }

        $rubro->fill($request->all());
        $rubro->save();

        Flash::success('Rubro updated successfully.');

        return redirect(route('rubros.index'));
    }

    /**
     * Remove the specified Rubro from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Rubro $rubro */
        $rubro = Rubro::find($id);

        if (empty($rubro)) {
            Flash::error('Rubro not found');

            return redirect(route('rubros.index'));
        }

        $rubro->delete();

        Flash::success('Rubro deleted successfully.');

        return redirect(route('rubros.index'));
    }
}
