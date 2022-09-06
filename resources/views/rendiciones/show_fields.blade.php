<!-- Cheque Id Field -->
<div class="col-sm-12">
    {!! Form::label('cheque_id', 'Cheque Id:') !!}
    <p>{{ $rendicion->cheque_id }}</p>
</div>

<!-- Inventario Id Field -->
<div class="col-sm-12">
    {!! Form::label('inventario_id', 'Inventario Id:') !!}
    <p>{{ $rendicion->inventario_id }}</p>
</div>

<!-- Recibo Id Field -->
<div class="col-sm-12">
    {!! Form::label('recibo_id', 'Recibo Id:') !!}
    <p>{{ $rendicion->recibo_id }}</p>
</div>

<!-- Importe Field -->
<div class="col-sm-12">
    {!! Form::label('importe', 'Importe:') !!}
    <p>{{ $rendicion->importe }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $rendicion->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $rendicion->updated_at }}</p>
</div>

