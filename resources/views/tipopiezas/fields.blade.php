<!-- Descrip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descrip', 'Descrip:') !!}
    {!! Form::text('descrip', null, ['class' => 'form-control']) !!}
</div>

<!-- Tecnica Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tecnica', 'Tecnica:') !!}
    {!! Form::text('tecnica', null, ['class' => 'form-control']) !!}
</div>

<!-- Rubro Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rubro_id', 'Rubro Id:') !!}
    {!! Form::select('rubro_id', $rubroItems, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Insumo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('insumo', 'Insumo:') !!}
    {!! Form::text('insumo', null, ['class' => 'form-control']) !!}
</div>