<!-- Recibo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recibo_id', 'Recibo Id:') !!}
    {!! Form::text('recibo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipopieza Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipopieza_id', 'Tipopieza Id:') !!}
    {!! Form::text('tipopieza_id', null, ['class' => 'form-control']) !!}
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