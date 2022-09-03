@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Rendición</h1>
            </div>

        </div>
    </div>
</section>

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">


    <form method="POST" action="{{ route('rendicion_guardar') }}" accept-charset="UTF-8" id="rendicion_guardar" name="rendicion_guardar" class="form-horizontal">
        {{ csrf_field() }}     


        <div class="card-body p-0">

 



            <div class="table-responsive">
                <table class="table" id="rendicion-table">
                    <thead>
                        <tr>
                            <th style="text-align: center">Inventario</th>
                            <th style="text-align: center;">Precio Unitario</th>
                            
                            <th style="text-align: center;">Descripción</th>
                            <th style="text-align: center;">Técnica</th>
                            <th style="text-align: center;">Precio</th>
                            <th style="text-align: center;">Artesano</th>
       
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($renglones as $renglon)
                        <tr>
                            
                            <td><input type="text"  id="inventario" name="inventario[]" value="{{ $renglon->inventario }}" readonly style="border: 0; text-align: right;" > </td>
                            <td><input type="text"  id="preciounit" name="preciounit[]" value="{{ $renglon->preciounit }}" readonly style="border: 0; text-align: right;" > </td>
                       
                            <td><input type="text"  id="descrip"    name="descrip[]"    value="{{ $renglon->descrip }}"    readonly style="border: 0; text-align: right;" > </td>
                            <td><input type="text"  id="tecnica"    name="tecnica[]"    value="{{ $renglon->tecnica }}"    readonly style="border: 0; text-align: right;" > </td>
                            <td><input type="text"  id="precio"     name="precio[]"     value="{{ $renglon->precio  }}"    readonly style="border: 0; text-align: right;" > </td>
                            <td><input type="text"  id="nombre"     name="nombre[]"     value="{{ $renglon->nombre  }}"    readonly style="border: 0; text-align: right;" > </td>

 
                       
 
                            <td width="120">
                        
                                <div class='btn-group'>

                                    <a href="{{ route('cheques.rendir', [$renglon->id]) }}"
                                        class="btn btn-sm btn-secondary float-right">Rendir</a>

                                    <a href="{{ route('cheques.rendir', [$renglon->id]) }}"
                                        class="btn btn-sm btn-info float-left">Rendición</a>

                                    <a href="{{ route('cheques.show', [$renglon->id]) }}" class='btn btn-default btn-xs'>
                                        <i class="far fa-eye"></i>
                                    </a>

                                    <a href="{{ route('cheques.edit', [$renglon->id]) }}" class='btn btn-default btn-xs'>
                                        <i class="far fa-edit"></i>
                                    </a>

                                   
                                </div>
                          
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>












            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>





                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input id="guardar_rendicion"  class="btn btn-primary" type="submit" value="Grabar Rendición">
                    </div>
                </div>

            </form>
        </div>




    </div>
</div>

@endsection