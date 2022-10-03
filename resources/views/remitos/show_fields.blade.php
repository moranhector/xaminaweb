<!-- Descrip Field -->
<div class="col-sm-12">
    {!! Form::label('descrip', 'Descrip:') !!}
    <p>{{ $remito->descrip }}</p>
</div>

<!-- Fecha Field -->
<div class="col-sm-12">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $remito->fecha }}</p>
</div>

<!-- Deposito Id From Field -->
<div class="col-sm-12">
    {!! Form::label('deposito_id_from', 'Deposito Id From:') !!}
    <p>{{ $remito->deposito_id_from }}</p>
</div>

<!-- Deposito Id To Field -->
<div class="col-sm-12">
    {!! Form::label('deposito_id_to', 'Deposito Id To:') !!}
    <p>{{ $remito->deposito_id_to }}</p>
</div>

<!-- User Name Field -->
<div class="col-sm-12">
    {!! Form::label('user_name', 'User Name:') !!}
    <p>{{ $remito->user_name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $remito->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $remito->updated_at }}</p>
</div>

