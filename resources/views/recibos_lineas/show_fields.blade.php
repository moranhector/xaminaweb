<!-- Recibo Id Field -->
<div class="col-sm-12">
    {!! Form::label('recibo_id', 'Recibo Id:') !!}
    <p>{{ $recibosLineas->recibo_id }}</p>
</div>

<!-- Tipopieza Id Field -->
<div class="col-sm-12">
    {!! Form::label('tipopieza_id', 'Tipopieza Id:') !!}
    <p>{{ $recibosLineas->tipopieza_id }}</p>
</div>

<!-- Cantidad Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{{ $recibosLineas->cantidad }}</p>
</div>

<!-- Preciounit Field -->
<div class="col-sm-12">
    {!! Form::label('preciounit', 'Preciounit:') !!}
    <p>{{ $recibosLineas->preciounit }}</p>
</div>

<!-- Importe Field -->
<div class="col-sm-12">
    {!! Form::label('importe', 'Importe:') !!}
    <p>{{ $recibosLineas->importe }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $recibosLineas->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $recibosLineas->updated_at }}</p>
</div>

