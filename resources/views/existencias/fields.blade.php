<!-- Inventario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inventario_id', 'Inventario Id:') !!}
    {!! Form::text('inventario_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipodoc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipodoc', 'Tipodoc:') !!}
    {!! Form::text('tipodoc', null, ['class' => 'form-control']) !!}
</div>

<!-- Documento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('documento', 'Documento:') !!}
    {!! Form::text('documento', null, ['class' => 'form-control']) !!}
</div>

<!-- Deposito Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deposito_id', 'Deposito Id:') !!}
    {!! Form::select('deposito_id', $depositoItems, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Tiposalida Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tiposalida', 'Tiposalida:') !!}
    {!! Form::text('tiposalida', null, ['class' => 'form-control']) !!}
</div>

<!-- Documento Sal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('documento_sal', 'Documento Sal:') !!}
    {!! Form::text('documento_sal', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Desde Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_desde', 'Fecha Desde:') !!}
    {!! Form::text('fecha_desde', null, ['class' => 'form-control','id'=>'fecha_desde']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_desde').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Fecha Hasta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_hasta', 'Fecha Hasta:') !!}
    {!! Form::text('fecha_hasta', null, ['class' => 'form-control','id'=>'fecha_hasta']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_hasta').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush