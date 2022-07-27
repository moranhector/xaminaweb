<!-- Numero Field -->
<div class="col-sm-12">
    {!! Form::label('numero', 'Numero:') !!}
    <p>{{ $cheque->numero }}</p>
</div>

<!-- Fecha Field -->
<div class="col-sm-12">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $cheque->fecha }}</p>
</div>

<!-- Importe Field -->
<div class="col-sm-12">
    {!! Form::label('importe', 'Importe:') !!}
    <p>{{ $cheque->importe }}</p>
</div>

<!-- Ncuenta Field -->
<div class="col-sm-12">
    {!! Form::label('ncuenta', 'Ncuenta:') !!}
    <p>{{ $cheque->ncuenta }}</p>
</div>

<!-- Depositado Field -->
<div class="col-sm-12">
    {!! Form::label('depositado', 'Depositado:') !!}
    <p>{{ $cheque->depositado }}</p>
</div>

<!-- Saldo Field -->
<div class="col-sm-12">
    {!! Form::label('saldo', 'Saldo:') !!}
    <p>{{ $cheque->saldo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $cheque->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $cheque->updated_at }}</p>
</div>

