<!-- Factura Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('factura_id', 'Factura Id:') !!}
    {!! Form::text('factura_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Inventario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inventario_id', 'Inventario Id:') !!}
    {!! Form::text('inventario_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::text('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Preciounit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('preciounit', 'Preciounit:') !!}
    {!! Form::text('preciounit', null, ['class' => 'form-control']) !!}
</div>

<!-- Importe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('importe', 'Importe:') !!}
    {!! Form::text('importe', null, ['class' => 'form-control']) !!}
</div>