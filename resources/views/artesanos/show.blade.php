@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Artesano</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('artesanos.index') }}">
                        Regresar a lista
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('artesanos.show_fields')
                </div>
            </div>
        </div>
    </div>


    <div class="card">
            <div class="card-body p-0">
            <div class="table-responsive">
    <table class="table" id="inventarios-table">
        <thead>
        <tr>

        <th>Pieza</th>
        <th>Descripción</th>
        <th>Compra</th>
        <th>Venta</th>
        <th>Costo</th>
        <th>Comprado</th>
        <th>Vendido</th>
 
 
        </tr>
        </thead>
        <tbody>
        @foreach($inventarios as $inventario)
            <tr>
            <td>{{ $inventario->npieza }}</td>
            <td>{{ $inventario->namepieza }}</td>
            <td>{{ $inventario->comprob }}</td>
            <td>{{ $inventario->factura }}</td>
            <td>{{ $inventario->costo }}</td>
            <td>{{ $inventario->comprado_at }}</td>
            <td>{{ $inventario->vendido_at }}</td>
 
  
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

    </div>









@endsection
