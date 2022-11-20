@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Registrar Recibo</h1>
                </div>
            </div>
        </div>
    </section>

    @include('flash::message')    


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    

    <div class="content px-3">

    <form method="POST" action="{{ route('guardar.recibo') }}" accept-charset="UTF-8" id="create_recibo_form" name="create_recibo_form" class="form-horizontal">
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


@push('formularios')





 
 
    <script src="{{asset('js/recibos.js')}}"></script>
 


@endpush



