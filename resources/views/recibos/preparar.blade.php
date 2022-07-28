@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Registrar Recibo {{$nuevo_formulario}}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

    <form method="POST" action="{{ route('recibos.store') }}" accept-charset="UTF-8" id="create_recibo_form" name="create_recibo_form" class="form-horizontal">
            {{ csrf_field() }} 
            @include ('recibos.form', [ 'recibo' => null, ]) 

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input id="guardarfactura"  class="btn btn-primary" type="submit" value="Grabar Recibo">
                    </div>
                </div>

            </form>
    </div>
@endsection
