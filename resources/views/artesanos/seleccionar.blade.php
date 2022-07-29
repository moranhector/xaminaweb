@extends('layouts.miniapp')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <script language="Javascript">
 
    function copiar_cerrar($docum,$nombre) {
      
        copiar_celdas($docum,$nombre);
        parent.close();
    }

    function copiar_celdas($documento,$nombre) {
        var prefix    = "";
        var pwintype = typeof parent.opener.document;

        

        if (pwintype != "undefined") {

                parent.opener.document.getElementById("documento").value  = $documento;
                //alert($documento);        
                parent.opener.document.getElementById("nombre").value  = $nombre;                
                //alert($nombre);                        
         
        }
    }


 
</script>

    <div style="background-color:#3c8dbc"  class="panel panel-default">

        <div>

            <div  class="text-center" >
                <h4 style="color:#ffffff;font-weight: bold; text-align=center" class="mt-5 mb-5">Seleccionar artesanos</h4>
            </div>

            <div class="form-group row">
                            <div class="col-md-6">

                            <nav class="navbar navbar-light bg-light">
                                <form class="form-inline" method {{route('seleccionar_artesanos')}} >
                                    <input name='buscarTexto' class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre o documento" 
                                    autocomplete='off' aria-label="Search" value="{{$buscarTexto}}" >
                                    <button style="font-weight: bold;  class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                                </form>
                            </nav> 

                            </div>
            </div>            


        </div>
        
        @if(count($artesanos) == 0)
            <div class="panel-body text-center">
                <h4 style="color:#ffffff;" >No hay Artesanos Disponibles.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table  style="background-color:#ffffff" class="table ">
                    <thead  style="background-color:#817C7B">
                        <tr>
                            <th style="color:#ffffff"  >Nombre</th>
                            <th style="color:#ffffff"  >DNI</th>
                 

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($artesanos as $artesano)
                        <tr>
                            <td  >{{ $artesano->nombre }}</td>
        
                            <td align="left" valign="top">&nbsp;
                                <a href="javascript:copiar_cerrar('{{ $artesano->documento }}','{{ $artesano->nombre }}');">{{ $artesano->documento }}</a>
                            </td>
     

                            <td>

                                                       

                                <form method="POST" action="{!! route('artesanos.destroy', $artesano->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}



                                </form> 
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $artesanos->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
@push('scripts')

@endpush

