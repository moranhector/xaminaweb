@extends('layouts.app')

<!-- @section('css') DATATABLE

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" >
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" >
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" >
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css" >
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" >


@endsection -->

@section('content')
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Artesanos</h1>
                <div class="col-sm">
                    <nav class="navbar navbar-light bg-light">
                        <form class="form-inline" method {{route('artesanos.index')}}>
                            <input name='nombre' class="form-control mr-sm-2" type="search"
                                placeholder="Buscar por nombre" value="{{ old('nombre') }}" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" title="Filtrar / Quitar Filtro"
                                type="submit">Filtrar / Quitar Filtro</button>
                        </form>
                    </nav>
                </div>
            </div>


            @can('ARTESANOS-CREAR')  
            <div class="col-sm-6">
                <a class="btn btn-primary float-right" href="{{ route('artesanos.create') }}">
                    Registrar nuevo
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
            @include('artesanos.table')

            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>


    {{ $artesanos->links() }}
</div>

@endsection









<!-- @section('js') DATATABLE

   



@endsection -->