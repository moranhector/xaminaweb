@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tipos de piezas</h1>
                <div class="col-sm">
                    <nav class="navbar navbar-light bg-light">
                        <form class="form-inline" method {{route('tipopiezas.index')}}>
                            <input name='descrip' class="form-control mr-sm-2" type="search"
                                placeholder="Buscar por descripción" value="{{ old('descrip') }}" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" title="Filtrar / Quitar Filtro"
                                type="submit">Filtrar / Quitar Filtro</button>
                        </form>
                    </nav>
                </div>
            </div>


            @can('TIPOPIEZA-CREAR') 
            <div class="col-sm-6">
                <a class="btn btn-primary float-right" href="{{ route('tipopiezas.create') }}">
                    Registrar tipo de Pieza
                </a>
            </div>
            @endcan

        </div>
</section>

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body p-0">
            @include('tipopiezas.table')

            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>

    {{ $tipopiezas->links() }}     
</div>

@endsection