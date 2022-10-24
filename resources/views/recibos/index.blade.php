@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Recibos de Compra</h1>

                    <div class="col-sm">
                    <nav class="navbar navbar-light bg-light">
                        <form class="form-inline" method {{route('recibos.index')}}>
                            <input name='formulario' class="form-control mr-sm-2" type="search"
                                placeholder="Buscar por número" value="{{ old('formulario') }}"
                                aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" title="Filtrar / Quitar Filtro"
                                type="submit">Filtrar / Quitar Filtro</button>
                        </form>
                    </nav>
                </div>                    


                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('preparar.recibo') }}">
                        Nuevo Recibo
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('recibos.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

