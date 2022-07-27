<!-- Formulario Field -->
<div class="col-sm-12">
    {!! Form::label('formulario', 'Formulario:') !!}
    <p>{{ $recibo->formulario }}</p>
</div>

<!-- Fecha Field -->
<div class="col-sm-12">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $recibo->fecha }}</p>
</div>

<!-- Artesano Id Field -->
<div class="col-sm-12">
    {!! Form::label('artesano_id', 'Artesano Id:') !!}
    <p>{{ $recibo->artesano_id }}</p>
</div>

<!-- Total Field -->
<div class="col-sm-12">
    {!! Form::label('total', 'Total:') !!}
    <p>{{ $recibo->total }}</p>
</div>

<!-- Cheque Id Field -->
<div class="col-sm-12">
    {!! Form::label('cheque_id', 'Cheque Id:') !!}
    <p>{{ $recibo->cheque_id }}</p>
</div>

<!-- Rendido Field -->
<div class="col-sm-12">
    {!! Form::label('rendido', 'Rendido:') !!}
    <p>{{ $recibo->rendido }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $recibo->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $recibo->updated_at }}</p>
</div>

