<!-- Factura Id Field -->
<div class="col-sm-12">
    {!! Form::label('factura_id', 'Factura Id:') !!}
    <p>{{ $faclinea->factura_id }}</p>
</div>

<!-- Inventario Id Field -->
<div class="col-sm-12">
    {!! Form::label('inventario_id', 'Inventario Id:') !!}
    <p>{{ $faclinea->inventario_id }}</p>
</div>

<!-- Cantidad Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{{ $faclinea->cantidad }}</p>
</div>

<!-- Preciounit Field -->
<div class="col-sm-12">
    {!! Form::label('preciounit', 'Preciounit:') !!}
    <p>{{ $faclinea->preciounit }}</p>
</div>

<!-- Importe Field -->
<div class="col-sm-12">
    {!! Form::label('importe', 'Importe:') !!}
    <p>{{ $faclinea->importe }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $faclinea->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $faclinea->updated_at }}</p>
</div>

