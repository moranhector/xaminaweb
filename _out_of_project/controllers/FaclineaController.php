<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFaclineaRequest;
use App\Http\Requests\UpdateFaclineaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Faclinea;
use Illuminate\Http\Request;
use Flash;
use Response;

class FaclineaController extends AppBaseController
{
    /**
     * Display a listing of the Faclinea.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Faclinea $faclineas */
        $faclineas = Faclinea::all();

        return view('faclineas.index')
            ->with('faclineas', $faclineas);
    }

    /**
     * Show the form for creating a new Faclinea.
     *
     * @return Response
     */
    public function create()
    {
        return view('faclineas.create');
    }

    /**
     * Store a newly created Faclinea in storage.
     *
     * @param CreateFaclineaRequest $request
     *
     * @return Response
     */
    public function store(CreateFaclineaRequest $request)
    {
        $input = $request->all();

        /** @var Faclinea $faclinea */
        $faclinea = Faclinea::create($input);

        Flash::success('Faclinea saved successfully.');

        return redirect(route('faclineas.index'));
    }

    /**
     * Display the specified Faclinea.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Faclinea $faclinea */
        $faclinea = Faclinea::find($id);

        if (empty($faclinea)) {
            Flash::error('Faclinea not found');

            return redirect(route('faclineas.index'));
        }

        return view('faclineas.show')->with('faclinea', $faclinea);
    }

    /**
     * Show the form for editing the specified Faclinea.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Faclinea $faclinea */
        $faclinea = Faclinea::find($id);

        if (empty($faclinea)) {
            Flash::error('Faclinea not found');

            return redirect(route('faclineas.index'));
        }

        return view('faclineas.edit')->with('faclinea', $faclinea);
    }

    /**
     * Update the specified Faclinea in storage.
     *
     * @param int $id
     * @param UpdateFaclineaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaclineaRequest $request)
    {
        /** @var Faclinea $faclinea */
        $faclinea = Faclinea::find($id);

        if (empty($faclinea)) {
            Flash::error('Faclinea not found');

            return redirect(route('faclineas.index'));
        }

        $faclinea->fill($request->all());
        $faclinea->save();

        Flash::success('Faclinea updated successfully.');

        return redirect(route('faclineas.index'));
    }

    /**
     * Remove the specified Faclinea from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Faclinea $faclinea */
        $faclinea = Faclinea::find($id);

        if (empty($faclinea)) {
            Flash::error('Faclinea not found');

            return redirect(route('faclineas.index'));
        }

        $faclinea->delete();

        Flash::success('Faclinea deleted successfully.');

        return redirect(route('faclineas.index'));
    }
}
