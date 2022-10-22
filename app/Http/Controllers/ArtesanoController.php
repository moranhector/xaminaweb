<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArtesanoRequest;
use App\Http\Requests\UpdateArtesanoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Artesano;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;

class ArtesanoController extends AppBaseController
{
    /**
     * Display a listing of the Artesano.
     *
     * @param Request $request
     *
     * @return Response
     */
    // public function index(Request $request)
    // {
    //     /** @var Artesano $artesanos */
    //     $artesanos = Artesano::all();

    //     return view('artesanos.index')
    //         ->with('artesanos', $artesanos);
    // }

    public function index(Request $request)
    {

        $nombre  = $request->get('nombre');

        if($nombre)
        {        
            $artesanos = DB::table('artesanos')
            ->where('nombre','like','%'.$nombre.'%' ) 
            ->paginate( 100 ) ;   

            $data['artesanos'] = $artesanos;     
            $data['nombre'] = $nombre;     

            Flash::success('Filtrando '.$nombre);              

            return view('artesanos.index',["artesanos"=>$artesanos,"nombre"=>$nombre]);            
        } 
        else
        {
            //$artesanos = Inventario::all()->paginate(25);
            $artesanos = DB::table('artesanos')->paginate(25);
        }
        return view('artesanos.index')
            ->with('artesanos', $artesanos);
    }
    



    public function seleccionar(Request $request)
    {
         if($request){

            $sql=trim($request->get('buscarTexto'));
            $artesanos=DB::table('artesanos')
            ->where('nombre','LIKE','%'.$sql.'%')
            ->orwhere('documento','LIKE','%'.$sql.'%')
            ->orderBy('id','asc')
            ->paginate(8);
            return view('artesanos.seleccionar',["artesanos"=>$artesanos,"buscarTexto"=>$sql]);
            //return $clientes;
        }
    }
    

    /**
     * Show the form for creating a new Artesano.
     *
     * @return Response
     */
    public function create()
    {
        return view('artesanos.create');
    }

    /**
     * Store a newly created Artesano in storage.
     *
     * @param CreateArtesanoRequest $request
     *
     * @return Response
     */
    public function store(CreateArtesanoRequest $request)
    {

        $request->validate([
            
                'nombre' => 'required',
                'documento' => 'required|unique:artesanos,documento',
                'cuit' => 'nullable|size:11',
                'direccion' => 'required',
                'lugar' => 'required',
                'departamento' => 'required',
                'nacimiento_at' => 'required',
                'sexo' => 'required',            

        ]);


        $input = $request->all();
        //dd($input);

        /** @var Artesano $artesano */
        $artesano = Artesano::create($input);

        Flash::success('Artesano guardado correctamente.');

        return redirect(route('artesanos.index'));
    }

    /**
     * Display the specified Artesano.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Artesano $artesano */
        $artesano = Artesano::find($id);

        if (empty($artesano)) {
            Flash::error('Artesano no encontrado');

            return redirect(route('artesanos.index'));
        }

        $inventarios = Inventario::where('inventarios.artesano_id', $id)
        ->get();      

        return view('artesanos.show', [
            "artesano"=>$artesano,
            "inventarios"=>$inventarios   ]);
    }

    /**
     * Show the form for editing the specified Artesano.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Artesano $artesano */
        $artesano = Artesano::find($id);

        if (empty($artesano)) {
            Flash::error('Artesano no encontrado');

            return redirect(route('artesanos.index'));
        }

        return view('artesanos.edit')->with('artesano', $artesano);
    }

    /**
     * Update the specified Artesano in storage.
     *
     * @param int $id
     * @param UpdateArtesanoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArtesanoRequest $request)
    {

        $request->validate([
            
            'nombre' => 'required',
            'documento' => 'required',
            'cuit' => 'nullable|size:11',
            'direccion' => 'required',
            'lugar' => 'required',
            'departamento' => 'required',
            'nacimiento_at' => 'required',
            'sexo' => 'required',            

        ]);





        /** @var Artesano $artesano */
        $artesano = Artesano::find($id);

        if (empty($artesano)) {
            Flash::error('Artesano no encontrado');

            return redirect(route('artesanos.index'));
        }

        $artesano->fill($request->all());
        $artesano->save();

        Flash::success('Artesano guardado correctamente.');

        return redirect(route('artesanos.index'));
    }

    /**
     * Remove the specified Artesano from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Artesano $artesano */
        $artesano = Artesano::find($id);

        if (empty($artesano)) {
            Flash::error('Artesano no encontrado');

            return redirect(route('artesanos.index'));
        }

        $artesano->delete();

        Flash::success('Artesano eliminado.');

        return redirect(route('artesanos.index'));
    }
}
