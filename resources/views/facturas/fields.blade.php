<!-- Formulario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('formulario', 'Formulario:') !!}
    {!! Form::text('formulario', null, ['class' => 'form-control']) !!}
</div>

<!-- Ptovta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ptovta', 'Ptovta:') !!}
    {!! Form::text('ptovta', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo:') !!}
    {!! Form::select('tipo', ['FACB' => 'FACB', 'NCB' => 'NCB'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Cliente Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cliente_id', 'Cliente Id:') !!}
    {!! Form::select('cliente_id', $clienteItems, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::text('total', null, ['class' => 'form-control']) !!}
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