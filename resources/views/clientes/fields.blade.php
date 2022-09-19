<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Ivacond Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ivacond', 'Ivacond:') !!}
    {!! Form::select('ivacond', ['Responsable Inscripto' => 'Responsable Inscripto', 'Consumidor Final' => 'Consumidor Final', 'Monotributista' => 'Monotributista'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Domicilio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('domicilio', 'Domicilio:') !!}
    {!! Form::text('domicilio', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipodoc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipodoc', 'Tipodoc:') !!}
    {!! Form::select('tipodoc', ['DNI' => 'DNI', 'CUIT' => 'CUIT', 'CI-EX' => 'CI-EX', 'LE' => 'LE', 'LC' => 'LC'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Documento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('documento', 'Documento:') !!}
    {!! Form::text('documento', null, ['class' => 'form-control']) !!}
</div>