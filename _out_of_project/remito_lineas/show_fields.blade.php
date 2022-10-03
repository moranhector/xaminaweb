<!-- Remito Id Field -->
<div class="col-sm-12">
    {!! Form::label('remito_id', 'Remito Id:') !!}
    <p>{{ $remitoLinea->remito_id }}</p>
</div>

<!-- Inventario Id Field -->
<div class="col-sm-12">
    {!! Form::label('inventario_id', 'Inventario Id:') !!}
    <p>{{ $remitoLinea->inventario_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $remitoLinea->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $remitoLinea->updated_at }}</p>
</div>

