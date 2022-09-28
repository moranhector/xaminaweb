@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Cheque</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($cheque, ['route' => ['cheques.update', $cheque->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('cheques.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Grabar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('cheques.index') }}" class="btn btn-default">Salir</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
