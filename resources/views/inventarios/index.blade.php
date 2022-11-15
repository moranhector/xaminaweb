@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Inventarios</h1>
                <div class="col-sm">
                    <nav class="navbar navbar-light bg-light">
                        <form class="form-inline" method {{route('inventarios.index')}}>
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
</section>

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body p-0">
            @include('inventarios.table')

            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>

    {{ $inventarios->links() }}


</div>

@endsection