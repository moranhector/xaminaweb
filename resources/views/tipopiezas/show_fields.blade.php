<!-- Descrip Field -->
<div class="col-sm-12">
    {!! Form::label('descrip', 'Descrip:') !!}
    <p>{{ $tipopieza->descrip }}</p>
</div>

<!-- Tecnica Field -->
<div class="col-sm-12">
    {!! Form::label('tecnica', 'Tecnica:') !!}
    <p>{{ $tipopieza->tecnica }}</p>
</div>

<!-- Rubro Id Field -->
<div class="col-sm-12">
    {!! Form::label('rubro_id', 'Rubro Id:') !!}
    <p>{{ $tipopieza->rubro_id }}</p>
</div>

<!-- Precio Field -->
<div class="col-sm-12">
    {!! Form::label('precio', 'Precio:') !!}
    <p>{{ $tipopieza->precio }}</p>
</div>

<!-- Insumo Field -->
<div class="col-sm-12">
    {!! Form::label('insumo', 'Insumo:') !!}
    <p>{{ $tipopieza->insumo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $tipopieza->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $tipopieza->updated_at }}</p>
</div>

