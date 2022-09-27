@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-8">
                <h1>Inventarios a Fecha</h1>
                <div class="row mb-8">
                    <div class="col-sm">
                        <nav class="navbar navbar-light bg-light">
                            <form class="form-inline" method {{route('inventario_fecha')}}>
                                <input type="date" id="start" name="fecha_hasta" value="{{ old('fecha_hasta') }}"
                                    min="2000-01-01" max="2050-12-31">


                                <button class="btn btn-outline-success my-2 my-sm-0" title="Aceptar"
                                    type="submit">Aceptar</button>
                            </form>
                        </nav>
                    </div>

                    <div class="col-sm">
                        <nav class="navbar navbar-light bg-light">
                            <form class="form-inline" method {{route('inventario_fecha')}}>
                                <input name='namepieza' class="form-control mr-sm-2" type="search"
                                    placeholder="Buscar por nombre o número" value="{{ old('namepieza') }}"
                                    aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" title="Filtrar / Quitar Filtro"
                                    type="submit">Filtrar / Quitar Filtro</button>
                            </form>
                        </nav>
                    </div>
                </div>

            </div>








        </div>
    </div>
</section>

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body p-0">
            @include('inventarios.table_inventario_fecha')

            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>

    {{ $inventarios->links() }}


</div>

@endsection